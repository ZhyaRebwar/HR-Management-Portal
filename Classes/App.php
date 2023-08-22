<?php

namespace Classes;

use Classes\Route;
use Controller\SignupController;
use Controller\LoginController;
use Controller\LogoutController;
use Controller\AdministratorController;
use Controller\HRController;
use Controller\EmployeeController;
use Controller\SupervisorController;
use Exceptions\NoUserException;
use Exceptions\PathException;

class App
{

    protected array $route;
    protected string $loginPathClass = "NotLoginException";

    public function __construct(private string $url, private string $method)
    {
        $url = explode("?", $url)[0];
    
    }

    public function run(): void
    {
        
        try
        {

            $method=strtolower( $this -> method);

            $url = $this -> url;

            $url_id = explode("/", $url);

            $body = (array) json_decode( file_get_contents('php://input'), true);

            if( preg_match( '/[0-9]+/', $url ) )
            {
                //gets the lever name
                $id_user = $this -> identify( (int) $url_id[2] );

                //here we get the 4th index, so that we can later check whether the operation is on another is or same user.
                if( (int) $url_id[4] )
                    $id_user2 = $this -> identify( (int) $url_id[4] );

                $id = [
                    'id_self' => $url_id[2],
                    'id_user'=> $url_id[4],
                    'title_self' => $id_user,
                    'title_user' => $id_user2
                ];


                $body['users'] = $id;

                $this -> getClass( $id_user );
                
                //making the uri match the routes
                $url = preg_replace( "/[0-9]+/", '[id]', $url);

                // if( !(bool) $id_user || !(bool) $id_user2 ) 
                //     throw new NoUserException;
                
            }


            $this -> routes();

            // throw exception(no routes found)
            if( !isset( $this->route[$method][$url] ) )
                throw new PathException;
            

            (new Route)->resolve( $this->route[$method][$url] , $method, $body);
        }
        catch( PathException $e )
        {
            echo json_encode( ['Error' => $e -> errorMessage() ] );
        }
        catch( NoUserException $e)
        {
            echo json_encode( ['Error' => $e -> errorMessage() ] );
        }
    }

    public function routes(): self
    {        

        $this->route= [
            'post' => 
            [
                '/HR-Management-Portal/signup/' => SignupController::class,
                '/HR-Management-Portal/login/' => LoginController::class,
                '/HR-Management-Portal/logout/' => LogoutController::class
            ],
            'get' => 
            [
                '/HR-Management-Portal/[id]/information/' => $this -> loginPathClass,
                '/HR-Management-Portal/[id]/information/[id]' => $this -> loginPathClass
            ],
            'delete' =>
            [
                '/HR-Management-Portal/[id]/delete/[id]' => $this -> loginPathClass
            ],
            'put' =>
            [
                '/HR-Management-Portal/[id]/update/[id]' => $this -> loginPathClass,
                '/HR-Management-Portal/[id]/update/' => $this -> loginPathClass
            ],
            'patch' =>
            [
                '/HR-Management-Portal/[id]/update/[id]' => $this -> loginPathClass,
                '/HR-Management-Portal/[id]/update/' => $this -> loginPathClass
            ]
        ];

        return $this;
    }



    private function identify(?int $id): string
    {
        //we connect to database here and get the class of the loged in user
        //in cases where we loged in the id of the user will be the third index
        
        //now connect to database to know the class type
        $result = (new Identifier) -> identify($id);

        return $result;
    }

    private function getClass(string $class): void
    {

        $classes = [
            'administrator' => AdministratorController::class,
            'hr' => HRController::class,
            'employee' => EmployeeController::class,
            'supervisor' => SupervisorController::class
        ];
        
        $this -> loginPathClass = $classes[$class];
    }
  
}