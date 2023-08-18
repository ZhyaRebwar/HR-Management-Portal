<?php

namespace Controller;

use Model\Users;
use Operations\ViewTrait;

class HRController
{
    use ViewTrait;

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