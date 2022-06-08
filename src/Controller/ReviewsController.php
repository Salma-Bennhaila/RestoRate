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

class ReviewsController extends AbstractController
{
    /**
     * @Route("/initReviews/{idR}", name="add_review_init",methods={"GET"})
     */
    public function initReviews($idR):Response{
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($idR); /** @var Restaurant $restaurant */
        return $this->render('reviews/addReviews.html.twig',['restaurant'=>$restaurant]);
    }

    /**
     * @Route("/delete_reviews/{idRV}", name="delete_reviews",methods={"POST"})
     */
    public function deleteReviews($idRV):Response{
        $em = $this->getDoctrine()->getManager();
        $review = $this->getDoctrine()->getRepository(Reviews::class)->find($idRV); /** @var Reviews $review */
        $idRestaurant = $review->getResraurantId()->getRestaurantId();
        $em->remove($review);
        $em->flush();
        return $this->redirectToRoute('get_one_restaurant',['id'=>$idRestaurant]);
    }

    /**
     * @Route("/addReview", name="add_reviews",methods={"POST"})
     */
    public function addReviews(Request $request):Response{
        $data = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        $reviews = new Reviews();
        $reviews->setMessage($data['message'])
            ->setNote($data['note'])
            ->setResraurantId($em->getReference(Restaurant::class, (int) $data['restaurant']))
            ->setUserId($em->getReference(User::class, (int) 2)); // il faut affecter l'utilisateur connecter
        $em->persist($reviews);
        $em->flush();
        return $this->redirectToRoute('get_one_restaurant',['id'=>$data['restaurant']]);
    }

}