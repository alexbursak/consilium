<?php

namespace ConsiliumBundle\Controller;

use ConsiliumBundle\Entity\ActivityType;
use ConsiliumBundle\Validator\ActivityTypeValidator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * ActivityType controller.
 */
class ActivityTypeController extends Controller
{
    /**
     * Lists all ActivityType entities.
     *
     * @return JsonResponse|Response
     */
    public function indexAction()
    {
        $days = $this->getDoctrine()->getRepository('ConsiliumBundle:ActivityType')->findAll();

        if(empty($days)){
            return new JsonResponse([]);
        }

        return new Response($this->serializeJson($days), 200, ['Content-type' => 'application/json']);
    }

    /**
     * Creates a new ActivityType entity.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        $validator = new ActivityTypeValidator($request->getContent());
        $validator->validate();

        if(!$validator->isValid()){
            return new JsonResponse($validator->getErrors());
        }

        $data = json_decode($request->getContent());

        $activityType = new ActivityType();
        $activityType->setNote($data->note);

        $em = $this->getDoctrine()->getManager();
        $em->persist($activityType);

        try{
            $em->flush();
        }catch (\Exception $e){
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('New ActivityType created');
    }

    /**
     * Finds and displays a ActivityType entity.
     *
     * @param ActivityType $activityType
     *
     * @return Response
     */
    public function showAction(ActivityType $activityType)
    {
        return new Response($this->serializeJson($activityType), 200, ['Content-type' => 'application/json']);
    }

    /**
     * Displays a form to edit an existing ActivityType entity.
     *
     * @param Request $request
     * @param ActivityType $activityType
     *
     * @return JsonResponse
     */
    public function editAction(Request $request, ActivityType $activityType)
    {
        $data = $request->getContent();

        $validator = new ActivityTypeValidator($data);
        $validator->validate();

        if(!$validator->isValid()){
            return new JsonResponse($validator->getErrors());
        }

        $data = json_decode($data);

        $activityType->setNote($data->note);

        $em = $this->getDoctrine()->getManager();
        $em->persist($activityType);

        try{
            $em->flush();
        }catch (\Exception $e){
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('ActivityType edited');
    }

    /**
     * Deletes a ActivityType entity.
     *
     * @param ActivityType $activityType
     *
     * @return JsonResponse
     */
    public function deleteAction(ActivityType $activityType)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($activityType);

        try{
            $em->flush();
        }catch (\Exception $e){
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('ActivityType has been deleted');
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
