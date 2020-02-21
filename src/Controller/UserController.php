<?php

namespace App\Controller;

use App\Entity\AssetCategories;
use App\Entity\Assets;
use App\Entity\IndividConnections;
use App\Entity\Individuals;

use App\Entity\UserConnections;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Entity\UserConnectionsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


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

    public function newIndivid(){

        $this->logger->info('newindivid');

        $entityManager = $this->getDoctrine()->getManager();

        $category = new AssetCategories();
        $category->setCategoryName("Pc-utstyr");
        $category->setActive(1);

        $individ = new Individuals();
        $individ->setFirstname("Mari");
        $individ->setLastname("Hansen");

        $asset = new Assets();
        $asset->setCategory($category);
        $asset ->setIndivid($individ);
        $asset->setAssetname('Skjerm');
        $asset->setDescription('Trådløs');

        $entityManager->persist($category);
        $entityManager->persist($individ);
        $entityManager->persist($asset);
        $entityManager->flush();

        return new JsonResponse('Nytt individ');
    }

    public function newItem(){

        $this->logger->info('newitem');

        $entityManager = $this->getDoctrine()->getManager();

        $category = $this->getDoctrine()->getRepository(AssetCategories::class)->find(1);

        $individ = $this->getDoctrine()->getRepository(Individuals::class)->find(7);

        $asset = new Assets();
        $asset->setCategory($category);
        $asset ->setIndivid($individ);
        $asset->setAssetname('Mus');
        $asset->setDescription('Trådløs');

        $entityManager->persist($category);
        $entityManager->persist($individ);
        $entityManager->persist($asset);
        $entityManager->flush();

        return new JsonResponse('Ny eiendel');
    }

    public function getAllUsers() {
        $individer = $this->getDoctrine()->getRepository(Individuals::class)->findAll();

        $this->logger->info("eeeeeeeeeee");


        return $this->json($individer, Response::HTTP_OK, [], [
            ObjectNormalizer::SKIP_NULL_VALUES => true,
            ObjectNormalizer::ATTRIBUTES => ['firstName', 'lastName'],
            ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
                return $object->getId();
            }
        ]);
    }

    public function getUserItems($iId){
        $this->logger->info($iId);

        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT individ2_id FROM individ_connections WHERE  individ1_id= 4';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $iId]);
        $aUsersId = $stmt->fetchAll();

        $this->logger->info(json_encode($aUsersId));

        $iIds = array_column($aUsersId, 'individ2_id');
        $this->logger->info(json_encode($iIds));

        for ($i = 0; $i <= 1; $i++){
            //if($id == $ids[$i]) {
                $this->logger->info('funnet');
                $this->logger->info(json_encode($i));
                //$this->render('users/getFriend.html.twig', array('user' => $user));
               // return $this->render('users/getFriend.html.twig', array('user' => $user));
           // }
        }
        $this->logger->info('ikke funnet');
        $user = $this->getDoctrine()->getRepository(Individuals::class)->find($iIds);
        return $this->render('users/getUserItems.html.twig', array('user' => $user));
    }

    public function getAllFriends($iId){
        $this->logger->info($iId);

        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT individ2_id FROM individ_connections WHERE individ1_id= 4';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user' => $iId]);

        $aUsersId = $stmt->fetchAll();

        $iIds = array_column($aUsersId, 'individ2_id');
        $this->logger->info(json_encode($iIds));

        $users = $this->getDoctrine()->getRepository(Individuals::class)->findBy(array('id' => $iIds));
        return $this->render('users/getAllFriends.html.twig', array('users' => $users));
    }

    /*public function getAllFollows($iId){
        $this->logger->info($iId);

        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT individ2_id FROM lånelitt.user_connections WHERE  user_id= 4 AND follow = 1';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user' => $iId]);

        $aUsersId = $stmt->fetchAll();

        $ids = array_column($aUsersId, 'user2_id');
        $this->logger->info(json_encode($ids));

        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id' => $ids));
        return $this->render('users/getAllFriends.html.twig', array('users' => $users));
    }*/

    /*public function getAllFollowers($iId){
        $this->logger->info($iId);

        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT user_id FROM lånelitt.user_connections WHERE  user2_id= 4 AND follow = 1';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user' => $iId]);

        $aUsersId = $stmt->fetchAll();

        $ids = array_column($aUsersId, 'user_id');
        $this->logger->info(json_encode($ids));

        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id' => $ids));
        return $this->render('users/getAllFriends.html.twig', array('users' => $users));
    }*/

    public function getFriend($iId){
        $user = $this->getDoctrine()->getRepository(Individuals::class)->find($iId);
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

            $user1 = $this->getDoctrine()->getRepository(Individuals::class)->find(4);
            $user2 = $this->getDoctrine()->getRepository(Individuals::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();

            $userConn = new IndividConnections();
            $userConn->setIndivid1($user1);
            $userConn->setIndivid2($user2);
            $entityManager->persist($userConn);
            $entityManager->flush();

            $userConn2 = new IndividConnections();
            $userConn2->setIndivid1($user2);
            $userConn2->setIndivid2($user1);

            $entityManager->persist($userConn2);
            $entityManager->flush();

            return new JsonResponse('Vennskap er opprettet');
        /*}
        return new JsonResponse('V');*/
    }

    public function newFollow(Request $request, $iId){
        $this->logger->info($request);
        $this->logger->info($iId);
        $this->logger->info('newFollow');

        $user1 = $this->getDoctrine()->getRepository(Individuals::class)->find($iId);
        $user2 = $this->getDoctrine()->getRepository(Individuals::class)->find(4);

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

    public function deleteFriendship(Request $request, $iId)
    {
        $this->logger->info($request);
        $this->logger->info($iId);

        //$this->delete($id);


        $conn = $this->getDoctrine()->getConnection();

        $sql = 'SELECT id
                FROM individ_connections
                WHERE  (individ1_id = 4 AND individ2_id = :id2)
                   OR (individ1_id = :id2 and individ2_id = 4)';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id2' => $iId]);
        $users_id = $stmt->fetchAll();

        $ids = array_column($users_id, 'id');
        $this->logger->info(json_encode($ids));

        /*if ($ids != null) {

            $id1 = $ids[0];
            $id2 = $ids[1];

            $user1 = $this->getDoctrine()->getRepository(UserConnections::class)->find($id1);
            $user2 = $this->getDoctrine()->getRepository(UserConnections::class)->find($id2);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user1);
            $entityManager->remove($user2);
            $entityManager->flush();
            $this->logger->info('vennskap mellom 4 og ' . $id . ' er slettet');

            $user = $this->getDoctrine()->getRepository(User::class)->find($id);
            return $this->render('users/getUserItems.html.twig', array('user' => $user));
        } else {
            $this->logger->info('vennskap finnes ikke');
        }*/
        return new JsonResponse('slettet');
    }

    /*public function delete($iId) {
        $conn = $this->getDoctrine()->getConnection();
        $sql = 'SELECT id 
                FROM lånelitt.user_connections 
                WHERE  (user_id = 4 AND user2_id = id) 
                   OR (user_id = id and user2_id = 4)';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $iId]);
        $aUsersId = $stmt->fetchAll();

        $ids = array_column($aUsersId, 'id');
        $this->logger->info(json_encode($ids));

        if($ids != null) {
            $id1 = $ids[0];
            $id2 = $ids[1];

            $user1 = $this->getDoctrine()->getRepository(IndividConnections::class)->find($id1);
            $user2 = $this->getDoctrine()->getRepository(IndividConnections::class)->find($id2);

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
    }*/

   /* public function getSearch(Request $request) {

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
        $users = $this->getDoctrine()->getRepository(Users::class)->findBy(array('username' => $username));
        return $this->render('users/getSearch.html.twig', array('users' => $users));

            /*return $this->redirectToRoute('get_search');

        }

        return $this->render('users/getSearch.html.twig', array(
            'form' => $form->createView()
        ));
    }*/

}