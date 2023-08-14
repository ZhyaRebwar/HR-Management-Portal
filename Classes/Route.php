<?php

namespace Classes;

class Route 
{

    
    public function resolve(string $class, string $method, ?array $params)
    {
    
        $this->$method($class, $method, $params);
       

    }

    public function get()
    {
        echo 'get is invoked';
    }

    public function post( $class, string $method, ?array $params)
    {
        $obj = new $class();
        call_user_func( [ $obj, $method], ...$params );

    }






}