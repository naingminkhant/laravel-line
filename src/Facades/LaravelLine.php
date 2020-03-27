<?php
/**
 * Created by naingminkhant
 * Date: 27/03/2020
 * Time: 16:04
 * Project: laravel-line
 */

namespace Arga\LaravelLine\Facades;

use Arga\LaravelLine\LineService;
use Illuminate\Support\Facades\Facade;

class LaravelLine extends Facade
{
    protected static function getFacadeAccessor()
    {
        return app()->make(LineService::class);
    }
}