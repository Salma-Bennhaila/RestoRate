<?php

namespace App\Controller;

use App\Entity\City;
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
     * @Route("/getRestaurant", name="get_list_restaurant",methods={"GET","HEAD"})
     */
    public function getRestaurant():Response{
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findRestaurant(); /** @var array $restaurants */
        return $this->render('restaurants/restaurant.html.twig',['restaurants'=>$restaurants]);
    }

    /**
     * @Route("/initAddRestaurant", name="init_add_restaurant",methods={"GET","HEAD"})
     */
    public function initAddRestaurant():Response{

        $city = $this->getDoctrine()->getRepository(City::class)->findAll(); /** @var $city City  */
        return $this->render('restaurants/addRestaurant.html.twig',['cityAll'=>$city]);
    }

    /**
     * @Route("/getOneRestaurant", name="get_one_restaurant",methods={"GET","HEAD"})
     */
    public function getOneRestaurant(Request $request):Response{
        $id = $request->get('id');
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id); /** @var Restaurant $restaurant */
        $reviews = $this->getDoctrine()->getRepository(Reviews::class)->findBy(['resraurantId'=>$id]); /** @var Reviews $reviews */
        return $this->render('restaurants/detailRestaurant.html.twig',['restaurant'=>$restaurant,'reviews'=>$reviews]);
    }


    /**
     * @Route("/getNoteRestaurant", name="get_noteMoy_restaurant",methods={"GET","HEAD"})
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
     * @Route("/getRestaurantByCity", name="get_restaurant_by_city",methods={"GET","HEAD"})
     */
    public function getRestaurantByCity(Request $request):Response{
        $city = $request->get('city');
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findRestaurantByCity($city); /** @var array $restaurants */
        return $this->render('restaurants/restaurantByCity.html.twig',['restaurants'=>$restaurants,'city'=>$city]);
    }

    /**
     * @Route("/getRestaurantAll", name="get_all_restau",methods={"GET","HEAD"})
     */
    public function getAll():Response{
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findAll(); /** @var  $restaurants */
        return $this->render('restaurants/listRestaurants.html.twig',['restaurants'=>$restaurants]);
    }

    /**
     * @Route("/add_restau", name="add_restau",methods={"POST"})
     */
    public function postRest(Request $request):Response{
        $data = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        $restaurant = new Restaurant();
        $restaurant->setRestaurantName($data['name'])
            ->setUpdateAt(new \DateTime())
            ->setCreateAt(new \DateTime())
            ->setCityId($em->getReference(City::class, (int) $data['city']))
            ->setUserId($em->getReference(User::class, (int) 1)); // il faut affecter l'utilisateur connecter
        $em->persist($restaurant);
        $em->flush();
        return $this->redirectToRoute('get_all_restau');
    }


    /**
     * @Route("/delete_restau/{id}", name="delete_restau",methods={"POST"})
     */
    public function deleteRestau(int $id):Response{
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find((int) $id); /** @var Restaurant $restaurant */
        $em = $this->getDoctrine()->getManager();
        $em->remove($restaurant);
        $em->flush();
        return $this->redirectToRoute('get_all_restau');
    }

}