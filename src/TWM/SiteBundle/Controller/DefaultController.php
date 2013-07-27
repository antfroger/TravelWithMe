<?php

namespace TWM\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TWMSiteBundle:Default:index.html.twig', array('name' => $name));
    }
}
