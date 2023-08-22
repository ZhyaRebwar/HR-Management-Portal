<?php

namespace Exceptions;

class NoAuthException extends ExceptionHandle
{
    public function errorMessage(): string
    {
        return "This user doesn't have authentication to do this action";
    }

}