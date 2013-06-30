<?php

namespace Antfroger\TravelWithMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function showAction($username)
    {
        return $this->render(
            'AntfrogerTravelWithMeBundle:User:show.html.twig',
            array('user' => array('username' => $username))
        );
    }

}
