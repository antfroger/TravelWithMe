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
class TravelController extends Controller
{

    /**
     * List all the ongoing travels
     *
     * @return Response A Response instance
     *
     * @Route(
     *   name = "twm_site_ongoing_travel",
     *   path = "/voyages/encours"
     * )
     * @Template("TWMSiteBundle:Travel:ongoing.html.twig")
     */
    public function viewOngoingAction()
    {
        $em = $this->getDoctrine()->getManager();

        $travels = $em->getRepository('TWMSiteBundle:Travel\Travel\Travel')->findOngoingTravels();

        return [
            'travels' => $travels
        ];
    }
}
