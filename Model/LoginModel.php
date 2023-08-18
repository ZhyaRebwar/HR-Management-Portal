<?php

namespace Model;

use Classes\TokenControl;

class LoginModel extends Model
{

    public function checkLogin($username, $password){
        $sql = $this
        ->select()
        ->table('accounts')
        ->condition("username=:username AND password=:password ");

        $statement = $this->db->prepare($sql->query);
        $statement->execute(
            [
                'username'=>$username,
                'password'=>$password
            ] );

        $result = $statement->fetch();

        // (new TokenControl)->createToken();
        echo json_encode( $result );

    }

}