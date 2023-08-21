<?php

namespace Constants;

enum UserTitles
{

    private const Administrator = 'administrator';
    private const Hr = 'hr';
    private const Supervisor = 'supervisor';
    private const Employee = 'employee';

    public static function checkAuthorizationView(): array
    {
        return [
            UserTitles::Administrator => ['administrator', 'hr', 'supervisor', 'employee'],
            UserTitles::Hr => [ 'hr', 'supervisor', 'employee'],
            UserTitles::Supervisor => ['employee']
        ];
    }

    public static function checkAuthorizationDelete(): array
    {
        return [
            UserTitles::Administrator => ['administrator', 'hr', 'supervisor', 'employee'],
            UserTitles::Hr => [ 'hr', 'supervisor', 'employee']
        ];
    }
    
}