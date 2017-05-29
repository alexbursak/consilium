<?php

namespace ConsiliumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ConsiliumBundle:Default:index.html.twig');
    }
}
