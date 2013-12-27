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

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TWM\SiteBundle\Entity\Travel\Step\Step;
use TWM\SiteBundle\Entity\Travel\Travel\Travel;

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
     */
    public function viewOngoingAction()
    {
        $travel1 = new Travel();
        $travel1
            ->setName('travel1')
            ->setSteps(new ArrayCollection(array(
                new Step(
                    new \DateTime('-12 days'),
                    new \DateTime('+ 2 days')
                )
            )));

        $travel2 = new Travel();
        $travel2
            ->setName('travel2')
            ->setSteps(new ArrayCollection(array(
                new Step(
                    new \DateTime('yesterday'),
                    new \DateTime('+ 3 days')
                )
            )));

        $travels = new ArrayCollection(array(
            $travel1,
            $travel2
        ));

        return $this->render(
            'TWMSiteBundle:Travel:ongoing.html.twig',
            array('travels' => $travels)
        );
    }
}
