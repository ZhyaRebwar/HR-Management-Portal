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
    
    
    // public function get():void
    // {
    //     echo "\n supervisor is invoked \n";
    // }

    public function checkEmployee(int $id_self, int $id_user): bool
    {
        //check whether the employee works for the supervisor selected.
        
        $this->userObj->checkEmployeeExist();

        $statement = $this->userObj->db->prepare( $this->userObj->query() );

        $statement -> execute(
            [
                'manager_id' => $id_self,
                'employee_id' => $id_user
            ] );

            $result = $statement -> fetch();


        return $result ? true : false;
    }
}