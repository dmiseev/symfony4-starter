<?php

namespace App\Domain\Core;

use Exception;

class EntityNotFound extends Exception implements DomainExceptionInterface
{
    protected $code = 404;
}