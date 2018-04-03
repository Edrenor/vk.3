<?php namespace App\CQRS\Facades;

use App\CQRS\Objects;
use Illuminate\Support\Facades\Facade;

class CqrsObjects extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Objects::class;
    }
}