<?php
namespace Pm\VisitorTracker\Facades;

use Illuminate\Support\Facades\Facade;

class VisitorTracker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Pm\VisitorTracker\Helpers\VisitorTracker::class;
    }
}
