<?php

namespace PUZ\PuzBundle\Controller;

use PUZ\PuzBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MessageController extends Controller
{
    public function createAction(Request $request)
    {
        $data = $request->getContent(); //on recoit du json que l'on transforme en objet
        $message = $this->get('jms_serializer')->deserialize($data, 'PUZ\PuzBundle\Entity\Message', 'json');

        $em = $this->getDoctrine()->getManager(); // on enregistre l'objet en bdd
        $em->persist($message);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function showAction(Message $message)
    {
        $data = $this->get('jms_serializer')->serialize($message, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    //retourner tous les messages
    public function listAction()
    {
        $message = $this->getDoctrine()->getRepository('PUZPuzBundle:Message')->findAll();

        $data = $this->get('jms_serializer')->serialize($message, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}