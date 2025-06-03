<?php

namespace App\Http\Controllers\Web\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Settings\Users\StoreRequest;
use App\Repositories\Settings\Roles\RolesRepository;
use App\Repositories\Settings\User\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    private $data = [];
    private $usersRepository;
    private $rolesRepository;

    public function __construct(
        UsersRepository $usersRepository,
        RolesRepository $rolesRepository
    ) {
        $this->usersRepository = $usersRepository;
        $this->rolesRepository = $rolesRepository;
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
            if ($request->method == "1") {
                $password = uniqid(13);
                $user = $this->usersRepository->store_all($request, $password);
            }
            
            if ($request->method == "0") {
                $user = $this->usersRepository->store($request);
            }
            
            // $this->rolesRepository->set($user, $request);

            // $data = $this->loginRepository->createToken($user, "first_access");

            // UserCreated::dispatch(
            //     $data['name'],
            //     $data['email'],
            //     $data['time'],
            //     $data['token'],
            //     $data['title'],
            // );

            return redirect()->back()->with("toast_success", "Usuário inserido, peça-o para verificar o email para cadastrar uma senha.");
        } catch (\Throwable $th) {
            return redirect()->back()->with("toast_error", "Erro ao inserir usuário, tente novamente em alguns instantes.")->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }
}
