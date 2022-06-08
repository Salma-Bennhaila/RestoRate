<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    /**
     * @Route("/initAdd", name="init_add")
     */
    public function initAddUser():Response{
        return $this->render('user/addUser.html.twig');

    }

    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('user/login.html.twig', [
              'controller_name' => 'LoginController',
              'last_username' => $lastUsername,
              'error'         => $error,
          ]);
    }


    /**
     * @Route("/loginTo", name="login_to_app")
     */
    public function loginToPage(Request $request){
        $data = $request->request->all();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$data['_username'],'password'=>$data['_password']]); /** @var User $user */
        if($user && in_array('ROLE_RESTAURANT',$user->getRoles())){
            return $this->redirectToRoute('get_all_restau');
        }
        return $this->render('user/NotFound.html.twig');
    }


    /**
     * @Route("/adduser", name="add_user",methods={"POST"})
     */
    public function addUser(Request $request){
        $data = $request->request->all();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$data['email']]); /** @var User $user */
        if($user){
            throw new \Exception('Email Exist '.$data['email']);
        }
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setUserName($data['username'])
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setCreateAt(new \DateTime())
            ->setUpdateAt(new \DateTime())
            ->setRoles((array)$data['role']);
        $em->persist($user);
        $em->flush();
        return $this->render('user/login.html.twig');
    }



}