<?php

namespace Exceptions;

class NoUserException extends ExceptionHandle
{
    public function errorMessage(): string
    {
        return 'User not found';
    }

}