<?php

namespace App\Http\Controllers\Web\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Settings\Users\StoreRequest;
use App\Http\Requests\Web\Settings\Users\UpdateRequest;
use App\Jobs\Auth\SendEmailToDoFirstAccess;
use App\Repositories\Settings\Roles\RolesRepository;
use App\Repositories\Settings\User\UsersRepository;
use App\Repositories\Tokens\UserTokens\UsersTokensRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    private $data = [];
    private $usersRepository;
    private $rolesRepository;
    private $userTokensRepository;

    public function __construct(
        UsersRepository $usersRepository,
        RolesRepository $rolesRepository,
        UsersTokensRepository $userTokensRepository
    ) {
        $this->usersRepository = $usersRepository;
        $this->rolesRepository = $rolesRepository;
        $this->userTokensRepository = $userTokensRepository;
    }

    public function index()
    {

        $this->data['users'] = $this->usersRepository->getAll();
        $this->data['roles'] = $this->rolesRepository->getAll();

        return view('pages.users.index')->with($this->data);
    }

    public function create()
    {

        $this->data['roles'] = $this->rolesRepository->getAll();

        return view('pages.users.create')->with($this->data);
    }

    public function store(StoreRequest $request)
    {

        try {
            $password = "null";

            if ($request->method == "1") {
                $password = Str::random(10);
                $user = $this->usersRepository->store_all($request, $password);
            }

            if ($request->method == "2") {
                $user = $this->usersRepository->store($request);
            }

            $this->rolesRepository->set($user, $request->role);

            $token = $this->userTokensRepository->store($user, "first_access");

            SendEmailToDoFirstAccess::dispatch(
                $user,
                $token->created_at,
                $token->id,
                $password,
                $request->method
            );

            return redirect()->back()->with("success", "Usuário inserido, peça-o para verificar o email para cadastrar uma senha.");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Erro ao inserir usuário, tente novamente em alguns instantes.")->withInput();
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {

            $user = $this->usersRepository->update($id, $request);
            $this->rolesRepository->update($user, $request->role);

            return redirect()->back()->with('success', 'Usuário atualizado com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erro ao atualizar usuário, tente novamente em alguns instantes');
        }
    }

    public function destroy($id)
    {
        try {
            $this->usersRepository->delete($id);
            return redirect()->back()->with('success', 'Registro removido com sucesso.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Registro não encontrado.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }
}
