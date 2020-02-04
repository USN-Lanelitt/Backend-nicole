<?php

namespace App\Controller;

use App\Entity\User;

use App\Entity\UserConnections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Entity\UserConnectionsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;


use Psr\Log\LoggerInterface;

class UserController extends AbstractController
{
    private $logger;
    private $session;
    //$sessionVal = $this->get('session')->get('aBasket');
    // Append value to retrieved array.

    public function __construct(LoggerInterface $logger, SessionInterface $session){
        $this->logger=$logger;
        $this->session = $session;
    }

    public function getAllUsers() {
        $users= $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('users/index.html.twig', array('users' => $users));
    }

    public function getUserItems($id){
        $this->logger->info($id);

        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT user2_id FROM lånelitt.user_connections WHERE  user_id= 4';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $users_id = $stmt->fetchAll();

        $this->logger->info(json_encode($users_id));

        $ids = array_column($users_id, 'user2_id');
        $this->logger->info(json_encode($ids));

        for ($i = 0; $i <= 1; $i++){
            //if($id == $ids[$i]) {
                $this->logger->info('funnet');
                $this->logger->info(json_encode($i));
                //$this->render('users/getFriend.html.twig', array('user' => $user));
               // return $this->render('users/getFriend.html.twig', array('user' => $user));
           // }
        }
        $this->logger->info('ikke funnet');
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        return $this->render('users/getUserItems.html.twig', array('user' => $user));
    }

    public function getAllFriends($id){
        $this->logger->info($id);

        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT user2_id FROM lånelitt.user_connections WHERE  user_id= 4 AND follow = 0';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user' => $id]);

        $users_id = $stmt->fetchAll();

        $ids = array_column($users_id, 'user2_id');
        $this->logger->info(json_encode($ids));

        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id' => $ids));
        return $this->render('users/getAllFriends.html.twig', array('users' => $users));
    }

    public function getAllFollows($id){
        $this->logger->info($id);

        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT user2_id FROM lånelitt.user_connections WHERE  user_id= 4 AND follow = 1';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user' => $id]);

        $users_id = $stmt->fetchAll();

        $ids = array_column($users_id, 'user2_id');
        $this->logger->info(json_encode($ids));

        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id' => $ids));
        return $this->render('users/getAllFriends.html.twig', array('users' => $users));
    }

    public function getAllFollowers($id){
        $this->logger->info($id);

        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT user_id FROM lånelitt.user_connections WHERE  user2_id= 4 AND follow = 1';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user' => $id]);

        $users_id = $stmt->fetchAll();

        $ids = array_column($users_id, 'user_id');
        $this->logger->info(json_encode($ids));

        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id' => $ids));
        return $this->render('users/getAllFriends.html.twig', array('users' => $users));
    }

    public function getFriend($id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        return $this->render('users/getFriend.html.twig', array('user' => $user));
    }

    public function newFriendship(Request $request, $id){
        //$this->delete($id);
        /*$conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT id 
                FROM lånelitt.user_connections 
                WHERE user_id = id and user2_id = 4';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $users_id = $stmt->fetchAll();

        $ids = array_column($users_id, 'id');
        $this->logger->info(json_encode($ids));

        if($ids = null  ) {*/

            $this->logger->info($request);
            $this->logger->info($id);
            $this->logger->info('newfriend');

            $user1 = $this->getDoctrine()->getRepository(User::class)->find(4);
            $user2 = $this->getDoctrine()->getRepository(User::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();

            $userConn = new UserConnections();
            $userConn->setUser($user1);
            $userConn->setUser2($user2);
            $userConn->setFollow(false);
            $entityManager->persist($userConn);
            $entityManager->flush();

            $userConn2 = new UserConnections();
            $userConn2->setUser($user2);
            $userConn2->setUser2($user1);
            $userConn2->setFollow(false);

            $entityManager->persist($userConn2);
            $entityManager->flush();

            return new JsonResponse('Vennskap er opprettet');
        /*}

        return new JsonResponse('V');*/

    }

    public function newFollow(Request $request, $id){
        $this->logger->info($request);
        $this->logger->info($id);
        $this->logger->info('newFollow');

        $user1 = $this->getDoctrine()->getRepository(User::class)->find(4);
        $user2 = $this->getDoctrine()->getRepository(User::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $userConn = new UserConnections();
        $userConn->setUser($user1);
        $userConn->setUser2($user2);
        $userConn->setFollow(true);

        $entityManager->persist($userConn);
        $entityManager->flush();

        $userConn2 = new UserConnections();
        $userConn2->setUser($user2);
        $userConn2->setUser2($user1);
        $userConn2->setFollow(false);

        $entityManager->persist($userConn2);
        $entityManager->flush();

        return new JsonResponse('følger');
    }

    public function deleteFriendship(Request $request, $id)
    {


        $this->logger->info($request);
        $this->logger->info($id);

        //$this->delete($id);


        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT id
                FROM lånelitt.user_connections
                WHERE  (user_id = 4 AND user2_id = :id2)
                   OR (user_id = 9 and user2_id = :id2)';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id2' => $id]);
        $users_id = $stmt->fetchAll();

        $ids = array_column($users_id, 'id');
        $this->logger->info(json_encode($ids));

        if ($ids != null) {

            $id1 = $ids[0];
            $id2 = $ids[1];

            $user1 = $this->getDoctrine()->getRepository(UserConnections::class)->find($id1);
            $user2 = $this->getDoctrine()->getRepository(UserConnections::class)->find($id2);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user1);
            $entityManager->remove($user2);
            $entityManager->flush();
            $this->logger->info('vennskap mellom 4 og ' . $id . ' er slettet');
        } else {
            $this->logger->info('vennskap finnes ikke');
        }
        return new JsonResponse('slettet');
    }

    public function delete( $id) {
        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT id 
                FROM lånelitt.user_connections 
                WHERE  (user_id = 4 AND user2_id = id) 
                   OR (user_id = id and user2_id = 4)';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $users_id = $stmt->fetchAll();

        $ids = array_column($users_id, 'id');
        $this->logger->info(json_encode($ids));

        if($ids != null) {
            $id1 = $ids[0];
            $id2 = $ids[1];

            $user1 = $this->getDoctrine()->getRepository(UserConnections::class)->find($id1);
            $user2 = $this->getDoctrine()->getRepository(UserConnections::class)->find($id2);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user1);
            $entityManager->remove($user2);
            $entityManager->flush();
            $this->logger->info('vennskap mellom 4 og '.$id.' er slettet');
        }
        else{
            $this->logger->info('vennskap finnes ikke');
        }
        return new JsonResponse('slettet');
    }

    public function getSearch(Request $request) {

        //$request = $this->getRequest();
        $data =$request->request->get('search_username');
        $this->logger->info(json_encode($data));

        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT * FROM user p 
                WHERE p.username 
                LIKE :data';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['data' => $data]);

        //$ids = array_column($users_id, 'user2_id');
        $this->logger->info(json_encode($data));

        $username = $stmt->fetchAll();
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('username' => $username));
        return $this->render('users/getSearch.html.twig', array('users' => $users));



            /*return $this->redirectToRoute('get_search');



        }

        return $this->render('users/getSearch.html.twig', array(
            'form' => $form->createView()
        ));*/
    }

}