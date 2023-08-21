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
        $this -> userObj = new Users();
    }

    

}