<?php

namespace Antfroger\TravelWithMeBundle\Controller;

use Antfroger\TravelWithMeBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
            ->getRepository('AntfrogerTravelWithMeBundle:User')
            ->findOneBy(array('username' => $username));

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for name ' . $username
            );
        }*/

        return $this->render(
            'AntfrogerTravelWithMeBundle:User:show.html.twig',
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

        return $this->forward('AntfrogerTravelWithMeBundle:User:show', array('username' => $user->getUsername()));
    }

}
