<?php

namespace Antfroger\TravelWithMeBundle\Controller;

use Antfroger\TravelWithMeBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
        return $this->render(
            'AntfrogerTravelWithMeBundle:User:show.html.twig',
            array('user' => $user)
        );
    }
    /*public function showAction($username)
    {
        $user = $this->getDoctrine()
            ->getRepository('AntfrogerTravelWithMeBundle:User')
            ->findOneBy(array('username' => $username));

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for name ' . $username
            );
        }

        return $this->render(
            'AntfrogerTravelWithMeBundle:User:show.html.twig',
            array('user' => $user)
        );
    }*/

    /**
     * Creates a User
     * @param string $username
     * @return Response
     */
    public function createAction($username)
    {
        $user = new User($username, 'test@test.fr', hash('sha256', 'mypassword'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('Created user id ' . $user->getId());
    }

}
