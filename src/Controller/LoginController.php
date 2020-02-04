<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;

$request = Request::createFromGlobals();

header("Access-Control-Allow-Origin: *");

class LoginController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger=$logger;
    }

    public function verifyLogin(Request $request)
    {
        $this->logger->info($request);

        $content = json_decode($request->getContent());
        $sUsername = $content->username;
        $sPassword = $content->password;

        $this->logger->info($sPassword);
        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT * FROM user WHERE username = :username';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['username' => $sUsername]);

        $return = $stmt->fetchAll();

        $db_iId       = "";
        $db_sName     = "";
        $db_sUsername = "";
        $db_sPassword = "";

        if (count($return) > 0)
        {
            $db_iId       = $return[0]['id'];
            $db_sName     = $return[0]['navn'];
            $db_sUsername = $return[0]['username'];
            $db_sPassword = $return[0]['password'];
        }

        if (password_verify($sPassword, $db_sPassword))
        {
            $sFeedback = "Bruker ". $db_sUsername ." er logget inn. ID: ".$db_iId." Navn: ".$db_sName;
        }
        else
        {
            $sFeedback = "Brukernavn eller passord finnes ikke";
        }

        return new JsonResponse($sFeedback);
    }
}