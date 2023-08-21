<?php

namespace Classes;

use Model\Users;
use Constants\UserTitles;

class CompareUserTitles
{

    private Users $userObj;
    public function __construct()
    {
        $this->userObj = new Users();
    }

    public function compareView(string $title_self, string $title_user): bool
    {
        $viewAuth = UserTitles::checkAuthorizationView();
        if( in_array( $title_user, $viewAuth[$title_self] ))
            return true;            
        
        return false;   
    }

    public function compareDelete(string $title_self, string $title_user ): bool
    {
        $deleteAuth = UserTitles::checkAuthorizationDelete();
        if( in_array( $title_user, $deleteAuth[$title_self] ))
            return true;

        return false;
    }

    public function compareUpdate(string $title_self, string $title_user): bool
    {
        $updateAuth = UserTitles::checkAuthorizationUpdate();
        if( in_array($title_user, $updateAuth[$title_self] ))
            return true;

        return false;
    }   
}