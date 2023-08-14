<?php

namespace Classes;

class TokenControl 
{

    public function createToken(array $email)
    {
        //create token (just email for now)
        echo json_encode( $email );
    }

    public function checkToken()
    {
        
        //to get the authorization header
        $headers = getallheaders();

        //to remove the bearer part of the token
        // var_dump( $headers['Authorization'] );
        $auth = explode(" ", $headers['Authorization'])[1];
        $auth = $auth=='null' ? null : $auth;

        //to check whether you loged in or not
        if(  $auth ) 
            echo json_encode( ["result"=>true]);
        else
            echo json_encode( ["result"=>false]);

    }

    public function destroyToken()
    {
        
        echo json_encode( ['logout' => true] );
    }
}