<?php

namespace Controller;

use Model\Users;
use Operations\ViewTrait;


class EmployeeController
{
    use ViewTrait;

    private Users $userObj;

    public function __construct()
    {
        $this->userObj = new Users();
    }

    
    // this case will override the one in the trait.
    // public function get():void
    // {
    //     echo 'hey';
    // }

}