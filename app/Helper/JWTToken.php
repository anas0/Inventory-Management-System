<?php

namespace App\Helper;

use Firebase\JWT\JWT;

class JWTToken
{
    public static function createToken($userEmail, $userId)
    {
        $key  = env("JWT_KEY");

        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 24 * 30,  //30 Days
            'userEmail' => $userEmail,
            'userId' => $userId
        ];
        return JWT::encode($payload, $key, 'HS256');
    } //End Method
}
