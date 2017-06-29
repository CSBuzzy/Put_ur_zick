<?php

namespace PUZ\PuzBundle\Controller;

use PUZ\PuzBundle\Entity\Channel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ChannelController extends Controller
{
    public function createAction(Request $request)
    {
        $data = $request->getContent(); //on recoit du json que l'on transforme en objet
        $channel = $this->get('jms_serializer')->deserialize($data, 'PUZ\PuzBundle\Entity\Channel', 'json');

        $em = $this->getDoctrine()->getManager(); // on enregistre l'objet en bdd
        $em->persist($channel);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function showAction(Channel $channel)
    {
        $data = $this->get('jms_serializer')->serialize($channel, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    //retourner toutes les channels
    public function listAction()
    {
        $channel = $this->getDoctrine()->getRepository('PUZPuzBundle:Channel')->findAll();

        $data = $this->get('jms_serializer')->serialize($channel, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}