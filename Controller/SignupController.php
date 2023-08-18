<?php

namespace Controller;
use Model\Users;

class SignupController
{
    private Users $signupObj;
    public function __construct()
    {
        $this->signupObj =  new Users();  
    }

    public function post(
        string $username, 
        string $email, 
        string $password, 
        string $first_name, 
        string $last_name,
        string $title,
        int $salary
        ): void
    {

      

        $this->signupObj->db->beginTransaction();

        $this->signupObj->createAccount( $username, $email, $password);

        $statement = $this->signupObj->db->prepare($this->signupObj->query() );

        $statement->execute( 
            [ 
            'username' => $username,
            'email' => $email,
            'password' => $password
            ] );   

        
        //second insert
        $lastInsertId = $this->signupObj->db->lastInsertId();
        $this->signupObj->addEmployeeInfo($lastInsertId, $first_name, $last_name);

        $statement = $this->signupObj->db->prepare($this->signupObj->query() );

        $statement->execute([ 
            'id' => $lastInsertId,
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);

        //third insert
        $this->signupObj->addEmployeeBenefits($lastInsertId, $title, $salary);
        
        $statement = $this->signupObj->db->prepare($this->signupObj->query() );

        $statement->execute( 
            [ 
            'id' => $lastInsertId,
            'title'=>$title,
            'salary'=>$salary
            ] );

        $this->signupObj->db->commit();

        echo "account has been created";
    }
}