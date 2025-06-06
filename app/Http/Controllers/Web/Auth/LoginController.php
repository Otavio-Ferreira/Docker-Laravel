<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\ResetRequest;
use App\Http\Requests\Web\Auth\SendRequest;
use App\Http\Requests\Web\Auth\StoreRequest;
use App\Jobs\Auth\SendEmailToResetPassword;
use App\Models\UserTokens;
use App\Repositories\Settings\User\UsersRepository;
use App\Repositories\Tokens\UserTokens\UsersTokensRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{

    private $userRepository;
    private $userTokensRepository;

    public function __construct(
        UsersRepository $userRepository,
        UsersTokensRepository $userTokensRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userTokensRepository = $userTokensRepository;
    }

    public function index()
    {
        return view('pages.authentication.index');
    }

    public function store(StoreRequest $request)
    {

        $key = 'login|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->with('error', "Muitas tentativas. Tente novamente em {$seconds} segundos.");
        }

        RateLimiter::hit($key, 300);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status == 1) {
                session(['last_login_temp' => Auth::user()->last_login_at]);
                $this->userRepository->updateLastLogin(Auth::user()->uuid);
                return redirect()->route('home.index');
            } else {
                Auth::logout();
                return back()->with("error", "verifique se o email e senha foram digitados corretamente.")->withInput();
            }
        }

        return back()->with("error", "verifique se o email e senha foram digitados corretamente.")->withInput();
    }

    public function reset()
    {
        return view('pages.authentication.reset');
    }

    public function send(SendRequest $request)
    {
        $user = $this->userRepository->getByEmail($request->email);

        if ($user && $user->status == 1) {
            try {
                $token = $this->userTokensRepository->store($user, "reset_password");

                SendEmailToResetPassword::dispatch(
                    $user,
                    $token->created_at,
                    $token->id,
                );

                return redirect()->back()->with("success", "Verifique a caixa de entrada do seu email.");
            } catch (\Throwable $th) {
                return redirect()->back()->with("error", "Erro ao enviar o email, tente novamente em alguns instantes.")->withInput();
            }
        }
        return redirect()->back()->with("error", "Erro ao enviar o email, tente novamente em alguns instantes.")->withInput();
    }

    public function edit(UserTokens $token)
    {
        if (isset($token)) {
            return view('pages.authentication.edit')->with('token_id', $token->id);
        }

        return to_route('login');
    }

    public function update(ResetRequest $request, UserTokens $token)
    {
        if (isset($token)) {
            try {
                $this->userRepository->updatePassword($request, $token->user_uuid);
                $this->userRepository->updateStatus($token->user_uuid, 1);
                $this->userTokensRepository->delete($token->id);

                return to_route('login')->with("success", "Senha atualizada, tente fazer login.");
            } catch (\Throwable $th) {
                return redirect()->back()->with("error", "Erro, tente novamente em alguns instantes.")->withInput();
            }
        }

        return redirect()->back()->with("error", "Error ao tentar alterar senha, tente novamente em alguns instantes.")->withInput();
    }

    public function register(UserTokens $token)
    {
        if (isset($token)) {
            return view('pages.authentication.register')->with('token_id', $token->id);
        }

        return to_route('login');
    }
}
