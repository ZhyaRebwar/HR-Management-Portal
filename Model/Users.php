<?php

namespace Model;

class Users extends Model
{

    public function createAccount(string $username, string $email, string $password): void
    {

        // $transaction = $this->db->beginTransaction();

        $sql = $this
            ->insert()
            ->table('accounts')
            ->columns('username, email, password')
            ->values(':username, :email, :password');
            
        
    }

    public function addEmployeeInfo(string $first_name, string $last_name): void
    {
        $lastInsertId = $this->db->lastInsertId();

        $sql = $this
            ->insert()
            ->table('employees_information')
            ->columns('id, first_name, last_name')
            ->values(':id, :first_name, :last_name');

    }
    
    public function query(): string
    {
        return $this->query;
    }

    public function checkLogin(string $username, string $password): void
    {
        $sql = $this
            ->select()
            ->table('accounts')
            ->condition('username =:username AND password =:password');

    }

    public function userLevel(string $username): void
    {
        $sql = $this
            ->select()
            ->table('accounts')
            ->condition('username =: username');

    }

}