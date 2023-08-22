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

    public function addEmployeeInfo(int $lastInsertId, string $first_name, string $last_name): void
    {

        $sql = $this
            ->insert()
            ->table('employees_information')
            ->columns('id, first_name, last_name')
            ->values(":id, :first_name, :last_name");
    }

    public function addEmployeeBenefits(int $lastInsertId, string $title, int $salary): void
    {

        $sql = $this
            ->insert()
            ->table('employee_benefits')
            ->columns('id, title, salary')
            ->values(":id, :title, :salary");
    }

    public function addEmployeeManager(): void
    {
        $this
            ->insert()
            ->table('employee_management')
            ->columns('manager_id', 'employee_id')
            ->values(":manager_id, :employee_id");
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

    public function userLevel(int $id): void
    {
        $sql = $this
            ->select('title')
            ->table('accounts')
            ->innerJoin()
            ->table('employee_benefits')
            ->on('accounts.id', 'employee_benefits.id')
            ->condition('accounts.id =:id');
    }

    public function selectUser(): void
    {
        $this
            ->select()
            ->table('accounts')
            ->innerJoin()
            ->table('employees_information')
            ->on('accounts.id', 'employees_information.id')
            ->innerJoin()
            ->table('employee_benefits')
            ->on('accounts.id', 'employee_benefits.id')
            ->condition('accounts.id =:id');

    }

    public function checkEmployeeExist(): void
    {
        $this
            ->select()
            ->table('employee_management')
            ->condition('manager_id =:manager_id AND employee_id =:employee_id');
    
    }

    public function deleteUser(): void
    {
        $this
            ->delete()
            ->table('accounts')
            ->condition('id =:id');
    }

    

    //-----------------------------------------
    private string $table_name;
    private string $columns;
    private string $conditions;

    public function setTable( $table_name): void
    {
        $this -> table_name = $table_name;
    } 

    public function getTable(): string
    {
        return $this -> table_name;
    }

    public function setColumn( string $colums ): void
    {
        $this -> columns = $colums;
    }

    public function getColumn(): string
    {
        return $this -> columns;
    }

    public function setCondition( string $conditions ): void
    {
        $this -> conditions = $conditions;
    }

    public function getCondition(): string
    {
        return $this -> conditions;
    }

    public function updateQuery(
        string $table_name,
        string $columns,
        string $conditions
    ): void
    {
        $this
            -> update()
            -> table( $table_name )
            -> set()
            -> column($columns)
            -> condition( $conditions );
    }
}
