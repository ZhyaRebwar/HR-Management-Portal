<?php

namespace Operations;

use Classes\CompareUserTitles;
use Exceptions\NoAuthException;

trait ViewTrait
{

    public function get(array $params): void
    {
        //to get the user portion of the array.
        $params = $params['users'];

        if (!$params['id_user']) 
            $this -> view(
                $params['id_self'],
                $params['title_self']
            );
        else 
            $this -> viewUser(...$params);
        
    }

    public function viewUser(int $id_self, int $id_user, string $title_self, string $title_user): void
    {
        //1. now we create a class to identify the job of the self and user title
        //to be able to check whether the information is allowed to share or not.
        try{
            $compareResult = (new CompareUserTitles) -> compareView($title_self, $title_user);
            
            $checkEmployee = true;
            //1.5 aya employee'aka sar ba supervisor'akaya...    awa bo supervisor.
            if( $title_self === 'supervisor' )
                $checkEmployee = $this -> checkEmployee($id_self, $id_user);
                

            //2. get the user from the database and do it by calling the view method.  
            if( $compareResult && $checkEmployee)
            {
                $result = $this -> getUser( $id_user );
                echo json_encode( $result );
            }
            else
                throw new NoAuthException;
        
        }
        catch( NoAuthException $e)
        {
            echo json_encode( ['Error' => $e -> errorMessage() ] );
        }


    }

    public function view(int $id, string $title): void
    {
        $result = $this -> getUser($id, $title);

        echo json_encode( $result );
    }

    public function getUser(int $id ): array
    {

        $this -> userObj -> selectUser();

        $statement = $this 
            -> userObj 
            -> db
            -> prepare( $this -> userObj -> query() );

        $statement -> execute(
            [
                'id' => $id
            ]);

        $result = $statement -> fetch();

        return $result;
    }
}
