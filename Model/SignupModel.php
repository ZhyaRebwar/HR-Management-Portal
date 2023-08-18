<?php

namespace Model;

class SignupModel extends Model
{


    public function createAccount(string $username, string $email, string $password, string $first_name, string $last_name)
    {
        // $sql = $this
        //     ->insert()
        //     ->table('accounts')
        //     ->columns('username, email, password')
        //     ->values(':username, :email, :password');

        // $transaction = $this->db->beginTransaction();
        
        $transaction = $this->db->beginTransaction();
        $sql = $this
            ->insert()
            ->table('accounts')
            ->columns('username, email, password')
            ->values(':username, :email, :password');
            
        $statement = $this->db->prepare($sql->query);
        $statement->execute( 
            [ 
            'username' => $username,
            'email'=>$email,
            'password'=>$password
            ] );        


        $lastInsertId = $this->db->lastInsertId();


        $sql = $this
            ->insert()
            ->table('employees_information')
            ->columns('id, first_name, last_name')
            ->values(':id, :first_name, :last_name');



        

        // $statement = $this->db->prepare($sql->query);
        // $statement->execute( 
        //     [ 
        //     'username'=>$username,
        //     'email'=>$email,
        //     'password'=>$password
        //     ] );

        // echo "\n" . $sql->query;

        $statement = $this->db->prepare($sql->query);
        $statement->execute( 
            [ 
            'id'=>$lastInsertId,
            'first_name'=>$first_name,
            'last_name'=>$last_name
            ] );

        $commit = $this->db->commit();


        //to check for what mr.omer said.
        // echo $this->db->getLastInsertedId();
    }

}