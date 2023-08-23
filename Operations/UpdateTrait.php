<?php

namespace Operations;

use Classes\CompareUserTitles;
use Exceptions\NoAuthException;

trait UpdateTrait
{

    public function put(
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
        string $appointed_at,
        array $users
        ): void
    {
        

        $workOnUserId = $users['id_self'];
        $workOnUserTitle = $users['title_self'];
        $compareResult = true;

        if( $users['id_user'] )
        {
            $compareResult = (new CompareUserTitles) -> compareUpdate(
                $users['title_self'], $users['title_user']
            );
            $workOnUserId = $users['id_user'];
            $workOnUserTitle = $users['title_user'];
        }

        $users = [
            'id_user' => $workOnUserId,
            'user_title' => $workOnUserTitle
        ];

        //update the entire data
        if( $compareResult )
            $this -> updateUser(
                $username, 
                $email, 
                $password, 
                $first_name, 
                $last_name,
                $phone_number,
                $date_of_birth, 
                $city,
                $relationship,
                $title,
                $salary,
                $bonus,
                $appointed_at,
                $users
            );
        else
        {
            //throw exception of now having the ability because of authentication
        }

    }

    public function patch(array $params): void
    {

        try
        {

            $users = $params['users'];
            $workOnUserId = $users['id_self'];
            $workOnUserTitle = $users['title_self'];
            $compareResult = true;

            if( $users['id_user'] )
            {
                $compareResult = (new CompareUserTitles) -> compareUpdate(
                    $users['title_self'], $users['title_user']
                );
                $workOnUserId = $users['id_user'];
                $workOnUserTitle = $users['title_user'];
            }

            $params['users'] = [
                'id_user' => $workOnUserId,
                'user_title' => $workOnUserTitle
            ];

            
            //get all the old data from the database
            $oldValues = $this -> getUser( $workOnUserId);
            $params['oldValues'] = $oldValues;

            //update the entire data
            if( $compareResult )
                $this -> updateUser(
                    $params['username'],
                    $params['email'],
                    $params['password'],
                    $params['first_name'],
                    $params['last_name'],
                    $params['phone_number'],
                    $params['date_of_birth'],
                    $params['city'],
                    $params['relationship'],
                    $params['title'],
                    $params['salary'],
                    $params['bonus'],
                    $params['appointed_at'],
                    $params['users'],
                    $params['oldValues']
                );
            else
                throw new NoAuthException;
            

        }
        catch( NoAuthException $e)
        {
            echo json_encode( ['Error' => $e -> errorMessage() ] );
        }
        
    }


    public function updateUser(
        string $username = null, 
        string $email = null, 
        string $password = null, 
        string $first_name = null, 
        string $last_name = null,
        int $phone_number = null,
        string $date_of_birth = null,
        string $city = null,
        int $relationship = null,
        string $title = null,
        int $salary = null,
        int $bonus = null,
        string $appointed_at = null,
        array $users,
        array $oldValues = null
    ): void
    {

    $this -> userObj -> db -> beginTransaction();

    $this -> userObj -> setTable('accounts');
    $this -> userObj -> setColumn('
        username =:username,
        email =:email,
        password =:password'
    );
    $this -> userObj -> setCondition('id =:id');

    $this -> userObj -> updateQuery(
        $this -> userObj -> getTable(),
        $this -> userObj -> getColumn(),
        $this -> userObj -> getCondition()
    );

    $statement = $this 
          -> userObj 
          -> db
          -> prepare( $this -> userObj -> query() );

    $success = $statement -> execute(
        [
            'id' => $users['id_user'],
            'username' => $username ? $username : $oldValues['username'],
            'email' => $email ? $email : $oldValues['email'], 
            'password' => $password ? $password : $oldValues['password'], 
        ]);

        
    //second table update
    $this -> userObj -> setTable('employees_information');
    $this -> userObj -> setColumn('
        first_name =:first_name,
        last_name =:last_name,
        phone_number =:phone_number,
        date_of_birth =:date_of_birth,
        city =:city,
        relationship =:relationship'
    );

    $this -> userObj -> updateQuery(
        $this -> userObj -> getTable(),
        $this -> userObj -> getColumn(),
        $this -> userObj -> getCondition()
    );

    $statement = $this 
          -> userObj 
          -> db
          -> prepare( $this -> userObj -> query() );

    $success = $statement -> execute(
        [
            'id' => $users['id_user'],
            'first_name' => $first_name ? $first_name : $oldValues['first_name'],
            'last_name' => $last_name ? $last_name : $oldValues['last_name'],
            'phone_number' => $phone_number ? $phone_number : $oldValues['phone_number'],
            'date_of_birth' => $date_of_birth ? $date_of_birth : $oldValues['date_of_birth'],
            'city' => $city ? $city : $oldValues['city'],
            'relationship' => $relationship ? $relationship : $oldValues['relationship']
        ]);
    

    //third table update
    $this -> userObj -> setTable('employee_benefits');
    $this -> userObj -> setColumn('
        title =:title,
        salary =:salary,
        bonus =:bonus,
        appointed_at =:appointed_at'
    );

    $this -> userObj -> updateQuery(
        $this -> userObj -> getTable(),
        $this -> userObj -> getColumn(),
        $this -> userObj -> getCondition()
    );

    $statement = $this 
          -> userObj 
          -> db
          -> prepare( $this -> userObj -> query() );

    $success = $statement -> execute(
        [
            'id' => $users['id_user'],
            'title' => $title ? $title : $oldValues['title'],
            'salary' => $salary ? $salary : $oldValues['salary'],
            'bonus' => $bonus ? $bonus : $oldValues['bonus'],
            'appointed_at' => $appointed_at ? $appointed_at : $oldValues['appointed_at']
        ]);

    $this -> userObj -> db -> commit();

        
      
    if( $success )
        echo json_encode( ['result' => 'account has been updated']);
    else
    echo json_encode( ['result' => 'account has not been updated']);

}

    

}