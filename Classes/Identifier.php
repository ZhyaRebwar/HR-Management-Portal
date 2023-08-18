<?php

namespace Classes;

use Model\Users;

class Identifier 
{

    private Users $dbObj; 
    public function __construct()
    {
        $this->dbObj = new Users();   
    }

    public function identify(int $id): string
    {
        $this->dbObj->userLevel($id);

        $statement = $this->dbObj->db->prepare( $this->dbObj->query() );

        $statement->execute(
            [
                'id' => $id
            ] );

        $result = $statement -> fetchColumn();

        return $result;
    }
}