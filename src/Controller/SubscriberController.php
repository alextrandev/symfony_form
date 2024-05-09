<?php

namespace App\Controller;

use App\Entity\Subscriber;
use App\Form\SubscriberFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriberController extends AbstractController {
    #[Route('/subscriber', name: 'app_subscriber')]
    public function show(): Response {
        $subscriber = new Subscriber(); //create a new entity instance
        $form = $this->createForm(SubscriberFormType::class, $subscriber); //create new form and connect fields with entity object

        return $this->render('subscriber/index.html.twig', [
            'subscriber_form' => $form->createView()
        ]); //create form view and pass to template
    }
}
