<?php

namespace App\Controller;

use App\Entity\Subscriber;
use App\Form\SubscriberFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriberController extends AbstractController {
    #[Route('/subscriber', name: 'app_subscriber')]
    public function subscribe(Request $req, EntityManagerInterface $em): Response {
        $subscriber = new Subscriber(); //create a new entity instance
        $form = $this->createForm(SubscriberFormType::class, $subscriber); //create new form and connect fields with entity object

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($subscriber);
            $em->flush();
            return $this->render('subscriber/confirm.html.twig');
        }

        return $this->render('subscriber/index.html.twig', [
            'subscriber_form' => $form->createView()
        ]); //create form view and pass to template
    }
}
