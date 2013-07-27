<?php

namespace TWM\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
