<?php

namespace Operations;

use Classes\CompareUserTitles;

trait DeleteTrait
{

    public function delete(array $params): void
    {
        $params = $params['users'];

        $this -> removeUser(...$params);
    }

    public function removeUser(int $id_self, int $id_user, string $title_self, string $title_user): void
    {
        //1. check wether the user has the ability to delete this type of user.
        $compareResult = (new CompareUserTitles) -> compareDelete($title_self, $title_user);
        
        //2. delete the user from the database
        if( $compareResult )
        {
            $result = $this -> deleteUser($id_user);
            echo json_encode( ['result' => 'record has been deleted'] );
        }
        else
            echo json_encode( ['result' => 'error' ] );   
    }

    public function deleteUser(int $id ): void
    {

        $this -> userObj -> deleteUser();

        $statement = $this 
            -> userObj 
            -> db 
            -> prepare( $this -> userObj -> query() );

        $statement -> execute(
            [
                'id' => $id
            ]);

    }
}