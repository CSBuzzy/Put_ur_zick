<?php

namespace PUZ\PuzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PUZPuzBundle:Default:index.html.twig');
    }
}
