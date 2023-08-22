<?php

namespace Exceptions;

use Exception;

class ExceptionHandle extends Exception
{
    public function errorMessage(): string
    {
        $errorMessage = "\nError on line:" . $this -> getLine() . "\n";
        $errorMessage .= 'File name:' . $this -> getFile() . "\n";
        $errorMessage .= 'Problem is:' . $this -> getMessage() . "\n";

        return $errorMessage;
    }

}