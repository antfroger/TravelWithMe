<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default Controller.
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render(
            'TWMDemoBundle:Default:index.html.twig',
            array('name' => $name)
        );
    }

}
