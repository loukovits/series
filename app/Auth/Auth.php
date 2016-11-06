<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();
        if (!$user){
            return false;
        }
        if (password_verify($password, $user->password)){
            if(empty($_SESSION['user'])){
                $_SESSION['user'] = true;
            }
            $_SESSION['user'] = $user->id;
            return true;
        }
        return false;
    }

    public function check()
    {
            return isset($_SESSION['user']);
    }

    public function user()
    {
        if (isset($_SESSION['user'])) {
            return User::find($_SESSION['user']);
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }
}