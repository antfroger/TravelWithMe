<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * TravelWithMe User Bundle
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class TWMUserBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
