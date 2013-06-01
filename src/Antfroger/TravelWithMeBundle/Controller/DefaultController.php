<?php

namespace Antfroger\TravelWithMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render(
            'AntfrogerTravelWithMeBundle:Default:index.html.twig',
            array('name' => $name)
        );
    }

}
