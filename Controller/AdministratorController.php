<?php

namespace Controller;

use Model\Users;
use Operations\DeleteTrait;
use Operations\ViewTrait;

class AdministratorController
{
    use ViewTrait;
    use DeleteTrait;

    private Users $userObj;

    public function __construct()
    {
        $this->userObj = new Users();
    }



    // public function get(string $a):void
    // {
    //     echo "\n Admin is invoked \n";
    // }

    
    
}