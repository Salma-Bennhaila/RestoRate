<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="get_login_page")
     */
    public function getLogin():Response{
        return $this->render('user/login.html.twig');
    }


    /**
     * @Route("/loginTo", name="login_to_app")
     */
    public function loginToPage(Request $request):Response{
        $data = $request->request->all();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=>$data['username']]); /** @var User $user */
        if($user->getUserRole() == 'restaurateur'){
            return $this->redirectToRoute('get_all_restau');
        }

    }


}