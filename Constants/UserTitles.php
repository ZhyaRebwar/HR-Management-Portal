<?php

namespace Constants;

enum UserTitles: string
{

    case Administrator = 'Administrator';
    case Hr = 'Hr';
    case Supervisor = 'Supervisor';
    case Employee = 'Employee';

    public static function checkAuthorization(): array
    {
        return [
            UserTitles::Administrator => ['Administrator', 'Hr', 'Supervisor', 'Employee'],
            UserTitles::Hr => ['Administrator', 'Hr', 'Supervisor', 'Employee'],
            UserTitles::Supervisor => ['Employee']
        ];
    }

    
}