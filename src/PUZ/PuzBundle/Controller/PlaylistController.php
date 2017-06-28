<?php

namespace PUZ\PuzBundle\Controller;

use PUZ\PuzBundle\Entity\Playlist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PlaylistController extends Controller
{
    public function createAction(Request $request)
    {
        $data = $request->getContent(); //on recoit du json que l'on transforme en objet
        $playlist = $this->get('jms_serializer')->deserialize($data, 'PuzBundle\Entity\Playlist', 'json');

        $em = $this->getDoctrine()->getManager(); // on enregistre l'objet en bdd
        $em->persist($playlist);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function showAction(Playlist $playlist)
    {
        $data = $this->get('jms_serializer')->serialize($playlist, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    //retourner toutes les playlist
    public function listAction()
    {
        $playlist = $this->getDoctrine()->getRepository('PuzBundle:Playlist')->findAll();
        $data = $this->get('jms_serializer')->serialize($playlist, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}