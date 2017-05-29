<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ActivityType;
use AppBundle\Entity\Day;
use AppBundle\Entity\SportActivity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SportActivityController extends Controller
{
    /**
     * @Route("/sport-activity/add", name="add_sport_activity")
     */
    public function addSportActivityAction(Request $request)
    {
        $formSent = $request->request->get('add-sport-activity-submit');
        if (isset($formSent)){
            $activityTypeName = $request->request->get('activity-type');
            $activityDate = $request->request->get('activity-day');
            $reps = $request->request->get('reps');
            $sets = $request->request->get('sets');
            $weight = $request->request->get('weight');

            $day = $this->getDoctrine()->getRepository('AppBundle:Day')->findDayByDate($activityDate);
            if(empty($day)){
                $day = new Day();
                $day->setDate(\DateTime::createFromFormat('d-m-Y', $activityDate));
                $day->setNote('note');
            }

            $activityType = $this->getDoctrine()->getRepository('AppBundle:ActivityType')->findOneBy(['note' => $activityTypeName]);

            $sportActivity = new SportActivity();
            $sportActivity->setDate(new \DateTime('now'));
            $activityType->addSportActivity($sportActivity);
            $sportActivity->setType($activityType);
            $sportActivity->setReps($reps);
            $sportActivity->setSets($sets);
            $sportActivity->setWeight($weight);
            $sportActivity->setDay($day);
            $sportActivity->setTitle('asdasdad');

            $em = $this->getDoctrine()->getManager();
            $em->persist($day);
            $em->persist($activityType);
            $em->persist($sportActivity);

            $em->flush();
        }

        $activityTypes = $this->getDoctrine()->getRepository('AppBundle:ActivityType')->findAll();
        $days = $this->getDoctrine()->getRepository('AppBundle:Day')->findAll();
        $defaultDate = new \DateTime('now');

        return $this->render('sport/add_sport_activity.html.twig', [
            'defaultDate' => $defaultDate->format('d-m-Y'),
            'days' => $days,
            'activityTypes' => $activityTypes
        ]);
    }
}
