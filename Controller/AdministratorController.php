<?php

namespace Controller;

use Model\Users;
use Operations\DeleteTrait;
use Operations\ViewTrait;
use Operations\UpdateTrait;

class AdministratorController
{
    use ViewTrait;
    use DeleteTrait;
    use UpdateTrait;

    private Users $userObj;

    public function __construct()
    {
        $this -> userObj = new Users();
    }

}