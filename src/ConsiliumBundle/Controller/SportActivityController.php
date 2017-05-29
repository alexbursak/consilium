<?php

namespace ConsiliumBundle\Controller;

use ConsiliumBundle\Entity\SportActivity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * SportActivity controller.
 *
 */
class SportActivityController extends Controller
{
    /**
     * Lists all SportActivity entities.
     */
    public function indexAction()
    {
        return new JsonResponse('indexAction');
    }

    /**
     * Creates a new SportActivity entity.
     */
    public function newAction(Request $request)
    {
        return new JsonResponse('newAction');
    }

    /**
     * Finds and displays a SportActivity entity.
     */
    public function showAction(SportActivity $day)
    {
        return new JsonResponse('showAction');
    }

    /**
     * Displays a form to edit an existing SportActivity entity.
     */
    public function editAction(Request $request, SportActivity $day)
    {
        return new JsonResponse('editAction');
    }

    /**
     * Deletes a SportActivity entity.
     */
    public function deleteAction(Request $request)
    {
        return new JsonResponse('deleteAction');
    }
}
