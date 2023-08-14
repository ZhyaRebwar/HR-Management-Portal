<?php

namespace Model;
use Classes\Db;

class Model
{

    public $db;
    public function __construct()
    {
        $this->db = (new Db())->pdoObject;
    }

    public function add(){
        $statement = $this->db->query("insert into accounts (username,email,password) values('zhya123', 'zhya@gmail.com', 'abc1')");
        echo "\n account added \n";
    }


    protected string $query;
    protected function begin(): self
    {
        $this->query = 'BEGIN; ';

        return $this;
    }

    protected function commit(): self
    {
        $this->query .= ' COMMIT;';

        return $this;
    }

    protected function select(string $select = "*"): self
    {
        $this->query = "SELECT $select FROM";

        return $this;
    }

    protected function table(string $table_name ): self
    {
        $this->query .= " $table_name";

        return $this;
    }

    protected function condition(string $condition ): self
    {
        $this->query .= " WHERE $condition";

        return $this;
    }

    protected function insert(): self
    {
        $this->query = "INSERT INTO";

        return $this;
    }

    protected function columns(string $string = "" ): self
    {
        $string = empty($string) ? "" : "($string)";
        $this->query .= " $string";

        return $this;
    }
    protected function values(string $string ): self
    {
        $this->query .= " VALUES ($string);";

        return $this;
    }

    protected function update(): self
    {
        $this->query = "UPDATE";

        return $this;
    }
    protected function set(string $string ): self
    {
        $this->query .= " SET $string";

        return $this;
    }

    protected function delete(): self
    {
        $this->query = "DELETE FROM";

        return $this;
    }

}