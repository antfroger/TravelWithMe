<?php

namespace Antfroger\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render(
            'AntfrogerDemoBundle:Default:index.html.twig',
            array('name' => $name)
        );
    }

}
