<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;

header("Access-Control-Allow-Origin: *");

class RegisterController extends AbstractController{

    public function registerUser(Request $request) {

        $this->logger->info($request);

        $content = json_decode($request->getContent());
        $sFullname = $content->fullname;
        $sUsername = $content->username;
        $sPassword = password_hash($content->password, PASSWORD_DEFAULT);

        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName($sFullname);
        $user->setUsername($sUsername);
        $user->setPassword($sPassword);

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse('Bruker '.$user->getUsername().' ble lagret');

    }
}