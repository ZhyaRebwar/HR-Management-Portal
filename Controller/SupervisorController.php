<?php

namespace Controller;

use Model\Users;
use Operations\ViewTrait;

class SupervisorController
{
    use ViewTrait;

    private Users $userObj;

    public function __construct()
    {
        $this->userObj = new Users();
    }
    
    
    public function get():void
    {
        echo "\n supervisor is invoked \n";
    }
}