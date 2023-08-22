<?php

namespace Exceptions;

class PathException extends ExceptionHandle
{
    public function errorMessage(): string
    {
        return 'Path not found';
    }

}