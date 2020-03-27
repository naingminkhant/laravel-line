<?php
/**
 * Created by naingminkhant
 * Date: 27/03/2020
 * Time: 16:19
 * Project: laravel-line
 */

namespace Arga\LaravelLine\Contracts;

interface LineManager
{
    public function authorize();

    public function token(string $code);

    public function profile(string $access_token);

    public function verify_token(string $access_token);

    public function refresh_token(string $access_token);

    public function logout(string $access_token);
}