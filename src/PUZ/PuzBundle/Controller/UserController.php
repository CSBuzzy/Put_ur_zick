<?php

namespace PUZ\PuzBundle\Controller;

use PUZ\PuzBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    public function createAction(Request $request)
    {
        $data = $request->getContent(); //on recoit du json que l'on transforme en objet
        $user = $this->get('jms_serializer')->deserialize($data, 'PUZ\PuzBundle\Entity\User', 'json');
        //$em = $this->getDoctrine()->getManager(); // on enregistre l'objet en bdd
        //$em->persist($user);
        //$em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function showAction(User $user)
    {
        $data = $this->get('jms_serializer')->serialize($user, 'json');
        dump($user);die;

        //$response = new Response($data);
        //$response->headers->set('Content-Type', 'application/json');

        return $response;

    }

}