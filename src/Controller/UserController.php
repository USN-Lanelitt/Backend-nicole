<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
  public function getUsers() {
      $users = $this->getDoctrine()->getRepository(User::class)->findAllUsers();

   /*speed(2);
       $users = [
           [
               'id' => 1,
               'fornavn' => 'Nicole1',
               'etternavn' => 'Bendu',
               'passord' => '1',

           ],
           [
               'id' => 2,
               'fornavn' => 'Nicole2',
               'etternavn' => 'Bendu',
               'passord' => '12',
           ],
           [
               'id' => 3,
               'fornavn' => 'Nicole3',
               'etternavn' => 'Bendu',
               'passord' => '123',
           ],
       ];

       $response = new Response();

       $response->headers->set('Content-Type', 'application/json');
       $response->headers->set('Access-Control-Allow-Origin', '*');

       $response->setContent(json_encode($users));

       return $response;


       /*$user = $this->getDoctrine()
           ->getRepository(User::class)
           ->findAll;

       if (!$user) {
           throw $this->createNotFoundException(
               'No product found for id '
           );
       }

       return new Response('Bruker: '.$user->getName());*/

       $response = new Response();

       $response->headers->set('Content-Type', 'application/json');
       $response->headers->set('Access-Control-Allow-Origin', '*');

       $response->setContent(json_encode($users));

       return $response;


    }
}