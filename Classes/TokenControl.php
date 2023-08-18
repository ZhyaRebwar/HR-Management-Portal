<?php

namespace Classes;

class TokenControl 
{

    public function createToken(array $email)
    {
        //create token (just email for now)
        echo json_encode( $email );
    }

    public function checkToken(): bool
    {
        
        //to get the authorization header
        $headers = getallheaders();

        //to remove the bearer part of the token
        // var_dump( $headers['Authorization'] );
        $auth = explode(" ", $headers['Authorization'])[1];
        $auth = $auth=='null' ? null : $auth;

        //to check whether you loged in or not
        if(  $auth ) 
        {
            echo json_encode( ["result"=>true]);
            return true; //to check it is Loged in
        }
        else
        {
            echo json_encode( ["result"=>false]);
            return false;
        }

    }

    public function destroyToken()
    {
        
        echo json_encode( ['logout' => true] );
    }
}