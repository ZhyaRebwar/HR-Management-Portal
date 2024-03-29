<?php

namespace Controller;

use Model\Users;
use Classes\TokenControl;

class LoginController
{

    private Users $loginObj;

    public function __construct()
    {
        $this -> loginObj = new Users();
    }

    public function post(string $username, string $password ): void
    {

        // test();
        try
        {

            $this -> loginObj -> checkLogin( $username, $password );

            $statement = $this 
                -> loginObj 
                -> db 
                -> prepare( $this -> loginObj -> query() );

            $statement -> execute(
                [
                    'username' => $username,
                    'password' => $password
                ] );

            $result = $statement -> fetch();

            (new TokenControl) -> createToken( $result );

        }
        catch ( \Throwable $e) {
            echo json_encode( ['Error' => 'Your username or password is incorrect' ] );
        }

        
    }

}