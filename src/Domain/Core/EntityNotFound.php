<?php

namespace App\Domain\Core;

class EntityNotFound extends \Exception
{
    protected $code = 404;
}