<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthFormRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function authenticate(AuthFormRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Usuário ou senha inválidos!'], 401);
        }
        $token = $user->createToken($request->device_name);

        return $token;
    }

    public function store(StoreUserRequest $request)
    {
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return $user;
        }
        catch(Exception $e){
            return response()->json(['Erro ao inserir usuário!', 404]);
        }
        
    }
}
