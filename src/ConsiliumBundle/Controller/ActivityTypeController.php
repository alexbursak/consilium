<?php

namespace ConsiliumBundle\Controller;

use ConsiliumBundle\Entity\ActivityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * ActivityType controller.
 */
class ActivityTypeController extends Controller
{
    /**
     * Lists all ActivityType entities.
     */
    public function indexAction()
    {
        return new JsonResponse('indexAction');
    }

    /**
     * Creates a new ActivityType entity.
     */
    public function newAction(Request $request)
    {
        return new JsonResponse('newAction');
    }

    /**
     * Finds and displays a ActivityType entity.
     */
    public function showAction(ActivityType $day)
    {
        return new JsonResponse('showAction');
    }

    /**
     * Displays a form to edit an existing ActivityType entity.
     */
    public function editAction(Request $request, ActivityType $day)
    {
        return new JsonResponse('editAction');
    }

    /**
     * Deletes a ActivityType entity.
     */
    public function deleteAction(Request $request)
    {
        return new JsonResponse('deleteAction');
    }
}
