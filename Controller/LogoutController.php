<?php

namespace Controller;

use Classes\TokenControl;

class LogoutController
{

    public function post(): void
    {
        (new TokenControl) -> destroyToken();
    }

}