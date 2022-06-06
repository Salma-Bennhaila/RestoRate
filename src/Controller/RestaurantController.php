<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\Reviews;
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
     * @Route("/getOneRestaurant", name="get_one_restaurant")
     */
    public function getOneRestaurant(Request $request):Response{
        $id = $request->get('id');
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id); /** @var Restaurant $restaurant */
        return $this->render('restaurants/detailRestaurant.html.twig',['restaurant'=>$restaurant]);
    }


    /**
     * @Route("/getNoteRestaurant", name="get_noteMoy_restaurant")
     */
    public function getNoteMoyRestaurant():Response{
        $reviews = $this->getDoctrine()->getRepository(Reviews::class)->getReviews(); /** @var array $reviews */
        $moyenneslist = $moyennes =  [];
        foreach ($reviews as $value){ /**@var Reviews $value **/
            $moyenneslist[$value->getResraurantId()->getRestaurantName()][]= $value->getNote();
        }
        $nb = 0; $somme = 0;
        if (is_array($moyenneslist)) {
            foreach($moyenneslist as $key => $nombre){
                foreach($nombre as $key1 => $nombre1){
                    $nb += empty($nombre1) ? 0 : 1;
                    $somme += floatval ($nombre1);
                }
                $moyennes[$key] = ($somme/$nb);
            }
        }
        return $this->render('restaurants/restaurantMoyenne.html.twig',['moyennes'=>$moyennes]);
    }


    /**
     * @Route("/getRestaurantByCity", name="get_restaurant_by_city")
     */
    public function getRestaurantByCity(Request $request):Response{
        $city = $request->get('city');
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findRestaurantByCity($city); /** @var array $restaurants */
        return $this->render('restaurants/restaurantByCity.html.twig',['restaurants'=>$restaurants,'city'=>$city]);
    }

    /**
     * @Route("/getRestaurantAll", name="get_all_restau")
     */
    public function getAll():Response{
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findAll(); /** @var  $restaurants */
        return $this->render('restaurants/listRestaurants.html.twig',['restaurants'=>$restaurants]);
    }

}