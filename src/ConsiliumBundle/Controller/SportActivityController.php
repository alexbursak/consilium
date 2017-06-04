<?php

namespace ConsiliumBundle\Controller;

use ConsiliumBundle\Entity\Day;
use ConsiliumBundle\Entity\SportActivity;
use ConsiliumBundle\Validator\SportActivityValidator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * SportActivity controller.
 */
class SportActivityController extends Controller
{
    /**
     * Lists all SportActivity entities.
     */
    public function indexAction()
    {
        $sportActivities = $this->getDoctrine()->getRepository('ConsiliumBundle:SportActivity')->findAll();

        if (empty($sportActivities)) {
            return new JsonResponse([]);
        }

        return new Response($this->serializeJson($sportActivities), 200, ['Content-type' => 'application/json']);
    }

    /**
     * Creates a new SportActivity entity.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        $validator = new SportActivityValidator($request->getContent());
        $validator->validate();

        if (!$validator->isValid()) {
            return new JsonResponse($validator->getErrors());
        }

        $em = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent());

        $sportActivity = new SportActivity();
        $sportActivity->setTitle($data->title);
        $sportActivity->setReps($data->reps);
        $sportActivity->setSets($data->sets);
        $sportActivity->setWeight($data->weight);

        $day = $this->getDoctrine()
            ->getRepository('ConsiliumBundle:Day')
            ->findDayByDate($data->date);
        if (null === $day) {
            $day = new Day();
            $day->setDate(\DateTime::createFromFormat('d-m-Y', $data->date));
        }
        $sportActivity->setDay($day);

        // TODO: rename 'note' field!
        $activityType = $this->getDoctrine()
            ->getRepository('ConsiliumBundle:ActivityType')
            ->findOneBy(['note' => $data->type]);
        if (null === $activityType) {
            return new JsonResponse('ERROR - Activity type not found');
        }
        $activityType->addSportActivity($sportActivity);
        $sportActivity->setType($activityType);

        $em->persist($sportActivity);
        $em->persist($day);
        $em->persist($activityType);

        try {
            $em->flush();
        } catch (\Exception $e) {
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('New SportActivity created');
    }

    /**
     * Finds and displays a SportActivity entity.
     *
     * @param SportActivity $sportActivity
     *
     * @return Response
     */
    public function showAction(SportActivity $sportActivity)
    {
        return new Response($this->serializeJson($sportActivity), 200, ['Content-type' => 'application/json']);
    }

    /**
     * Displays a form to edit an existing SportActivity entity.
     */
    public function editAction(Request $request, SportActivity $sportActivity)
    {
        $validator = new SportActivityValidator($request->getContent());
        $validator->validate();

        if (!$validator->isValid()) {
            return new JsonResponse($validator->getErrors());
        }

        $em = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent());

        if (null === $sportActivity) {
            return new JsonResponse('ERROR - Activity not found');
        }
        $sportActivity->setTitle($data->title);
        $sportActivity->setReps($data->reps);
        $sportActivity->setSets($data->sets);
        $sportActivity->setWeight($data->weight);

        $day = $this->getDoctrine()
            ->getRepository('ConsiliumBundle:Day')
            ->findDayByDate($data->date);
        if (null === $day) {
            $day = new Day();
            $day->setDate(\DateTime::createFromFormat('d-m-Y', $data->date));
        }
        $sportActivity->setDay($day);

        // TODO: rename 'note' field!
        $activityType = $this->getDoctrine()
            ->getRepository('ConsiliumBundle:ActivityType')
            ->findOneBy(['note' => $data->type]);
        if (null === $activityType) {
            return new JsonResponse('ERROR - Activity type not found');
        }
        $activityType->addSportActivity($sportActivity);
        $sportActivity->setType($activityType);

        $em->persist($sportActivity);
        $em->persist($day);
        $em->persist($activityType);

        try {
            $em->flush();
        } catch (\Exception $e) {
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('SportActivity edited');
    }

    /**
     * @param SportActivity $sportActivity
     *
     * @return JsonResponse
     */
    public function deleteAction(SportActivity $sportActivity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($sportActivity);

        try {
            $em->flush();
        } catch (\Exception $e) {
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('SportActivity has been deleted');
    }

    /**
     * @param $data
     *
     * @return string
     */
    private function serializeJson($data)
    {
        $serializer = $this->get('jms_serializer');

        return $serializer->serialize($data, 'json');
    }
}
