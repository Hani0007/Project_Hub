<?php
namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use ArrayAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface 

{

public function register( array $data)
{
 $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'=> $user,
           'token'=>$token

        ];
}

   public function login(array $data){
     $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
           return null;
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
             'user'=>$user,
            'token'=>$token

        ];
    }
  
 public function logout()
    {
        $user = [];
        auth()->$user()->currentAccessToken()->delete();
        return true;
    }




}










?>