<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ActivityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $activityTypes = $this->getDoctrine()->getRepository('AppBundle:ActivityType')->findAll();
        $days = $this->getDoctrine()->getRepository('AppBundle:Day')->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'days' => $days,
            'activityTypes' => $activityTypes,
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
