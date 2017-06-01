<?php

namespace ConsiliumBundle\Controller;

use ConsiliumBundle\Entity\Day;
use ConsiliumBundle\Validator\DayValidator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Day controller.
 */
class DayController extends Controller
{
    /**
     * Lists all day entities.
     */
    public function indexAction()
    {
        $days = $this->getDoctrine()->getRepository('ConsiliumBundle:Day')->findAll();

        if(empty($days)){
            return new JsonResponse([]);
        }

        return new Response($this->serializeJson($days), 200, ['Content-type' => 'application/json']);
    }

    /**
     * Creates a new day entity.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        $validator = new DayValidator($request->getContent());
        $validator->validate();

        if(!$validator->isValid()){
            return new JsonResponse($validator->getErrors());
        }

        $data = json_decode($request->getContent());

        $day = new Day();
        $day->setDate(\DateTime::createFromFormat('d-m-Y', $data->date));
        $day->setNote($data->note);

        $em = $this->getDoctrine()->getManager();
        $em->persist($day);

        try{
            $em->flush();
        }catch (\Exception $e){
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('New day created');
    }

    /**
     * Finds and displays a day entity.
     *
     * @param Day $day
     *
     * @return Response
     */
    public function showAction(Day $day)
    {
        return new Response($this->serializeJson($day), 200, ['Content-type' => 'application/json']);
    }

    /**
     * Displays a form to edit an existing day entity.
     *
     * @param Request $request
     * @param Day $day
     *
     * @return JsonResponse
     */
    public function editAction(Request $request, Day $day)
    {
        $data = $request->getContent();

        $validator = new DayValidator($data);
        $validator->validate();

        if(!$validator->isValid()){
            return new JsonResponse($validator->getErrors());
        }

        $data = json_decode($data);

        $day->setNote($data->note);

        $em = $this->getDoctrine()->getManager();
        $em->persist($day);

        try{
            $em->flush();
        }catch (\Exception $e){
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('Day edited');
    }

    /**
     * Deletes a day entity.
     *
     * @param Day $day
     *
     * @return JsonResponse
     */
    public function deleteAction(Day $day)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($day);

        try{
            $em->flush();
        }catch (\Exception $e){
            return new JsonResponse('ERROR - failed write to DB - code: ' . $e->getCode());
        }

        return new JsonResponse('Day has been deleted');
    }

    private function serializeJson($data)
    {
        return $this->get('serializer')->serialize($data, 'json');
    }

}
