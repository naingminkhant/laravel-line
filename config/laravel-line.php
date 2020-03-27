<?php
/**
 * Created by naingminkhant
 * Date: 27/03/2020
 * Time: 16:33
 * Project: laravel-line
 */

return [
    'client_id'     => env('LINE_CLIENT_ID', 'your line client_id'),
    'client_secret' => env('LINE_CLIENT_SECRET', 'your line client_secret'),
    'redirect'      => env('LINE_REDIRECT_URI', 'your line redirect_uri'),
];