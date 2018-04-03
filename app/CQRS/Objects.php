<?php namespace App\CQRS;

class Objects
{

    public function lastCreatedId($model)
    {
        return app('createdObjects')->getFlash($model);
    }

    public function lastUpdatedId($model)
    {
        return app('updatedObjects')->getFlash($model);
    }

    public function lastDeletedId($model)
    {
        return app('deletedObjects')->getFlash($model);
    }

    public static function clearBag($model)
    {
        return app('deletedObjects')->clear($model);
    }
}