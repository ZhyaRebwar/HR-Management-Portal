<?php

namespace Classes;

class Route
{


    public function resolve(string $class, string $method, ?array $params): void
    {

        $this->$method($class, $method, $params);
    }

    public function get($class, string $method, ?array $params): void
    {
        var_dump($class . ' is the class' . "\n" . 'get is invoked');
        $obj = new $class();
        call_user_func([$obj, $method], $params);
    }

    public function post($class, string $method, ?array $params): void
    {
        $obj = new $class();
        //there is a thing need to be finished about how the data is sent!!!
        call_user_func([$obj, $method], ...$params);
    }

    public function delete($class, string $method, ?array $params): void
    {
        $obj = new $class();
        call_user_func([$obj, $method], $params);
    }
}
