<?php

namespace Classes;

class Route
{

    public function resolve(string $class, string $method, ?array $params): void
    {
        $this->$method($class, $method, $params);
    }

    private function get($class, string $method, ?array $params): void
    {
        $obj = new $class();
        call_user_func([$obj, $method], $params);
    }

    private function post($class, string $method, ?array $params): void
    {
        $obj = new $class();
        //there is a thing need to be finished about how the data is sent!!!
        call_user_func([$obj, $method], ...$params);
    }

    private function delete($class, string $method, ?array $params): void
    {
        $obj = new $class();
        call_user_func([$obj, $method], $params);
    }

    private function put($class, string $method, array $params): void
    {
        $obj = new $class();
        call_user_func([$obj, $method], ...$params);
    }

    private function patch($class, string $method, array $params): void
    {
        $obj = new $class();
        call_user_func([$obj, $method], $params);
    }
}
