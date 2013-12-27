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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default Controller.
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class TravelController extends Controller
{
    public function viewOngoingAction()
    {
        return $this->render('TWMSiteBundle:Travel:ongoing.html.twig');
    }
}
