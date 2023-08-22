<?php

namespace Controller;

use Model\Users;

class SignupController
{
    private Users $signupObj;

    public function __construct()
    {
        $this -> signupObj = new Users();  
    }

    public function post(
        string $username, 
        string $email, 
        string $password, 
        string $first_name, 
        string $last_name,
        int $phone_number,
        string $date_of_birth,
        string $city,
        int $relationship,
        string $title,
        int $salary,
        int $bonus,
        // string $appointed_at,
        int $manager_id = null
        // int $employee_id = null
        ): void
    {

      

        $this -> signupObj -> db -> beginTransaction();

        $this -> signupObj -> createAccount( $username, $email, $password);

        $statement = $this 
            -> signupObj 
            -> db 
            -> prepare($this -> signupObj -> query() );

        $statement -> execute( 
            [ 
            'username' => $username,
            'email' => $email,
            'password' => $password
            ]);   

        
        //second insert
        $lastInsertId = $this -> signupObj -> db -> lastInsertId();
        $this -> signupObj -> addEmployeeInfo( $lastInsertId, $first_name, $last_name);

        $statement = $this 
            -> signupObj 
            -> db 
            -> prepare($this -> signupObj -> query() );

        $statement -> execute([ 
            'id' => $lastInsertId,
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);

        //third insert
        $this -> signupObj -> addEmployeeBenefits( $lastInsertId, $title, $salary);
        
        $statement = $this 
            -> signupObj 
            -> db 
            -> prepare($this -> signupObj -> query() );

        $statement -> execute( 
            [ 
            'id' => $lastInsertId,
            'title' => $title,
            'salary' => $salary
            ]);

        // fourth insert adding manager to the employee
        //we check wether is is employee -> add manager to it
        //manager -> add employees on the road later on separately(by using put or patch)
        
        
        $this -> signupObj -> setTable('employee_benefits');
        $this -> signupObj -> setColumn('title');
        $this -> signupObj -> setCondition('id =:id');

        $this -> signupObj -> selectQuery(
            $this -> signupObj -> getColumn(),
            $this -> signupObj -> getTable(),
            $this -> signupObj -> getCondition()
        );

        $statement = $this 
          -> signupObj 
          -> db
          -> prepare( $this -> signupObj -> query() );

        $statement -> execute( [ 'id' => $lastInsertId ]);

        $job_title = $statement -> fetch();

        $result = true;
        if( $job_title === 'employee' )
        {

            $this -> signupObj -> setTable('employee_management');
            $this -> signupObj -> setColumn('manager_id, employee_id');
            $this -> signupObj -> setValues('
                manager_id =:manager_id,
                employee_id =:employee_id'
            );

            $this -> signupObj -> insertQuery(
                $this -> signupObj -> getTable(),
                $this -> signupObj -> getColumn(),
                $this -> signupObj -> getValues()
            );

            $statement = $this 
            -> signupObj 
            -> db
            -> prepare( $this -> signupObj -> query() );
            
            $statement -> execute( 
                [ 
                    'manager_id' => $manager_id,
                    'employee_id' => $lastInsertId
                ]);
            
            
        }

        
        if( $result )
            $this -> signupObj -> db -> commit();

        echo "account has been created";
    }
}