<?php
/**
 * Created by naingminkhant
 * Date: 26/03/2020
 * Time: 13:53
 * Project: nestle-member
 */

namespace Arga\LaravelLine;

use Arga\LaravelLine\Contracts\LineManager;

class LineService implements LineManager
{
    const AUTHORIZE_URL = 'https://access.line.me/oauth2/v2.1/authorize';
    const TOKEN_URL = 'https://api.line.me/oauth2/v2.1/token';
    const PROFILE_URL = 'https://api.line.me/v2/profile';
    const REFRESH_TOKEN_URL = 'https://api.line.me/oauth2/v2.1/token';
    const VERIFY_TOKEN_URL = 'https://api.line.me/oauth2/v2.1/verify';
    const REVOKE_URL = 'https://api.line.me/oauth2/v2.1/revoke';

    protected function lineApi(): HttpClient
    {
        return new HttpClient(config('laravel-line'));
    }

    public function authorize()
    {
        $link = [
            'response_type' => 'code',
            'client_id'     => config('laravel-line.client_id'),
            'redirect_uri'  => config('laravel-line.redirect'),
            'state'         => hash('sha256', microtime(true).rand().$_SERVER['REMOTE_ADDR']),
        ];

        return self::AUTHORIZE_URL.'?'.http_build_query($link).'&scope=profile%20openid%20email';
    }

    public function token(string $code)
    {
        return $this->lineApi()
            ->setParams([
                'grant_type' => 'authorization_code',
                'code'       => $code,
            ])
            ->post(self::TOKEN_URL);
    }

    public function profile(string $access_token)
    {
        return $this->lineApi()
            ->setHeaders([
                'Authorization' => "Bearer $access_token",
            ])
            ->get(self::PROFILE_URL);
    }

    public function verify_token(string $access_token)
    {
        return $this->lineApi()
            ->setParams([
                'access_token' => $access_token,
            ])
            ->get(self::VERIFY_TOKEN_URL);
    }

    public function refresh_token(string $refresh_token)
    {
        return $this->lineApi()
            ->setParams([
                'grant_type'    => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_secret' => config('laravel-line.client_secret'),
            ])
            ->post(self::REFRESH_TOKEN_URL);
    }

    public function logout(string $access_token)
    {
        return $this->lineApi()
            ->setParams([
                'client_secret' => config('laravel-line.client_secret'),
                'access_token'  => $access_token,
            ])
            ->post(self::REVOKE_URL);
    }
}
