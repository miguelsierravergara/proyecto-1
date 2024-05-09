<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\DTOs\AuthUsersDTO;
//use Illuminate\Support\Facades\Hash;
//use App\Repositories\EloquentUsersRepository;
use App\Repositories\Contracts\Users\UsersRepositoryInterface;

class CreateUserController extends Controller
{
    public function __construct(private readonly UsersRepositoryInterface $userRepository)
    {}

    public function __invoke(Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        //Cuando usamos DTO
        $authUsersDTO = new AuthUsersDTO();

        $authUsersDTO->setName($name);
        $authUsersDTO->setEmail($email);
        $authUsersDTO->setPassword($password);

        $this->userRepository->create($authUsersDTO);

        // CUANDO HACEMOS EL LLAMADO A TRAVES DE UN CONTRATO.
        //$this->userRepository->create($name, $email, $password);
        
        // CUANDO HACEMOS EL LLAMADO DIRECTAMENTE DEL REPOSITORIO.
        //$userRepository = new EloquentUsersRepository;
        //$userRepository->store($name, $email, $password);
        
        // PARA TRABAJAR A NIVEL API.
        //return response()->json('Usuario registrado exitosamente.');
        // PARA EJECUTAR A NIVEL WEB.
        return view('store');
    }
}