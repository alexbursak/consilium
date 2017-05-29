<?php

namespace ConsiliumBundle\Controller;

use ConsiliumBundle\Entity\Day;
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

        $response = $this->serializeJson($days);

        return new Response($response);
    }

    /**
     * Creates a new day entity.
     */
    public function newAction(Request $request)
    {
        return new JsonResponse('newAction');
    }

    /**
     * Finds and displays a day entity.
     */
    public function showAction(Day $day)
    {
        return new JsonResponse('showAction');
    }

    /**
     * Displays a form to edit an existing day entity.
     */
    public function editAction(Request $request, Day $day)
    {
        return new JsonResponse('editAction');
    }

    /**
     * Deletes a day entity.
     */
    public function deleteAction(Request $request)
    {
        return new JsonResponse('deleteAction');
    }

    private function serializeJson($data)
    {
        return $this->get('serializer')->serialize($data, 'json');
    }

}
