<?php

namespace PUZ\PuzBundle\Controller;

use PUZ\PuzBundle\Entity\Song;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SongController extends Controller
{
    public function createSongAction(Request $request)
    {
        $data = $request->getContent(); //on recoit du json que l'on transforme en objet
        $song = $this->get('jms_serializer')->deserialize($data, 'PUZ\PuzBundle\Entity\Song', 'json');
        $em = $this->getDoctrine()->getManager(); // on enregistre l'objet en bdd
        $em->persist($song);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    public function showSongAction(Song $song)
    {
        $data = $this->get('jms_serializer')->serialize($song, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    //retourner toutes les songs
    public function listSongAction()
    {
        $song = $this->getDoctrine()->getRepository('PUZPuzBundle:Song')->findAll();

        $data = $this->get('jms_serializer')->serialize($song, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}