<?php
/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default Controller.
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route(
     *   name = "twm_site_homepage",
     *   path = "/"
     * )
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('TWMSiteBundle:Default:index.html.twig');
    }
}
