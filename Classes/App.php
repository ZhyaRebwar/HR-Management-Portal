<?php

namespace Classes;

use Classes\Route;
use Controller\SignupController;
use Controller\LoginController;
use Controller\LogoutController;
use Exception;



class App
{

    protected array $route;

    public function __construct(private string $url, private string $method)
    {
        $url = explode("?", $url)[0];
        
        

    }

    public function run()
    {
        

        $method=strtolower($this->method);

        $url = $this->url;

        $url1 = explode("/", $url);

        if( preg_match( '/[0-9]+/', $url ) )
        {
            $url = preg_replace( "/[0-9]+/", '[id]', $url);
        }

        if( isset( $this->route[$method][$url] ) )
        {
            echo "it exists \n";
        }else
        {
            echo "it doesn't exist \n";
        }

        
        $body = (array) json_decode( file_get_contents('php://input'), true);

        (new Route)->resolve(   $this->route[$method][$url] , $method, $body);
    }

    public function routes(): self
    {
        $this->route= [
            "post" => [
                '/HR-Management-Portal/signup/' => SignupController::class,
                '/HR-Management-Portal/[id]/information/' => SignupController::class,
                '/HR-Management-Portal/login/' => LoginController::class,
                '/HR-Management-Portal/logout/' => LogoutController::class
            ]
        ];

        return $this;
    }


}