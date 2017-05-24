<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Day;
use AppBundle\Entity\SportActivity;
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

//        phpinfo();
//        $day = $this->getDoctrine()
//            ->getRepository('AppBundle:Day')
//            ->find(1);
//        var_dump($day);die;
//
//        $day = new Day();
//        $day->setDate(new \DateTime('now'));
//        $day->setNote('Some Note');
//
//        $sportActivity = new SportActivity();
//        $sportActivity->setDay($day);
//        $sportActivity->setDate($day->getDate());
//        $sportActivity->setReps(12);
//        $sportActivity->setSets(12);
//        $sportActivity->setWeight(2.2);
//        $sportActivity->setTitle('title?');
//        $day->addSportActivity($sportActivity);
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($day);
//        $em->persist($sportActivity);
//        $em->flush();

        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('localhost3301@gmail.com')
            ->setTo('alexbursak3@gmail.com')
            ->setBody('Bodyyyy');
        $this->get('mailer')->send($message);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
