<?php

namespace Yangyifan\Pay\Facades;

use Illuminate\Support\Facades\Facade;

class SmsManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Pay';
    }
}