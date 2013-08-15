<?php

namespace TWM\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TWMUserBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
