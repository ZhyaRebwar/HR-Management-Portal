<?php

namespace Controller;

use Model\Users;
use Operations\DeleteTrait;
use Operations\ViewTrait;

class HRController
{
    use ViewTrait;
    use DeleteTrait;

    private Users $userObj;

    public function __construct()
    {
        $this->userObj = new Users();
    }
    
    
    // public function get():void
    // {
    //     echo "\n hr is invoked \n";
    // }

    
}