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

use TWM\DemoBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * User Controller.
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class UserController extends Controller
{

    /**
     * Displays User data
     * @param string $username
     * @return Response
     */
    public function showAction(User $user)
    {
        /* Not necessary, the user is automatically retrieved by doctrine because the parameter is casted
        $user = $this->getDoctrine()
            ->getRepository('TWMDemoBundle:User')
            ->findOneBy(array('username' => $username));

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for name ' . $username
            );
        }*/

        return $this->render(
            'TWMDemoBundle:User:show.html.twig',
            array('user' => $user)
        );
    }

    /**
     * Creates a User
     * @param string $username
     * @return Response
     */
    public function createAction($username)
    {
        $user = new User($username, $username . '@' . $username . '.fr', hash('sha256', $username));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->forward('TWMDemoBundle:User:show', array('username' => $user->getUsername()));
    }

}
