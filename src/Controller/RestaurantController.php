<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/getRestaurant", name="get_list_restaurant")
     */
    public function getRestaurant():Response{
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findRestaurant(); /** @var array $restaurants */
        return $this->render('restaurants/restaurant.html.twig',['restaurants'=>$restaurants]);
    }


    /**
     * @Route("/getNoteRestaurant", name="get_noteMoy_restaurant")
     */
    public function getNoteMoyRestaurant():Response{
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findRestaurant(); /** @var array $restaurants */
        return $this->render('restaurants/restaurant.html.twig',['restaurants'=>$restaurants]);
    }

}