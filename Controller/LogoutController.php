<?php

namespace Controller;

use Classes\TokenControl;

class LogoutController
{

    public function post()
    {

        (new TokenControl)->destroyToken();

    }

}