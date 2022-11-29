<?php

namespace App\Controller;

use App\Entity\Trips;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function travelHomePage(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/", name="index")
     */
    public function displayAll(ManagerRegistry $doctrine): Response
    {
        $trips = $doctrine->getRepository(Trips::class)->findAll();
        /*   dd($trips); */
        return $this->render('trips/index.html.twig', [
            "trips" => $trips
        ]);
    }

    /**
     * @Route("/test", name="app_test") //to display the database on the home, remove the other two functiones and merge them
     */
    /* public function travelHomePage(ManagerRegistry $doctrine): Response
    {
        $trips = $doctrine->getRepository(Trips::class)->findAll();
        return $this->render('trips/index.html.twig', [
            "trips" => $trips
        ]);
    } */

    /**
     * @Route("/test/about", name="app_test1")
     */
    public function travelAbout(): Response
    {
        return $this->render('test/indexAbout.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    /**
     * @Route("/test/news", name="app_test2")
     */
    public function travelNews(): Response
    {
        return $this->render('test/indexNews.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    /**
     * @Route("/test/contact", name="app_test3")
     */
    public function travelContact(): Response
    {
        return $this->render('test/indexContact.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function createTrips(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $trip = new Trips();
        /*  dd($trip); */
        $trip->setName("Sicily");
        $trip->setItinerary("Palermo, Marsala, Trapani, Favignana");
        $trip->setPrice(2000);
        $trip->setDeparture(new \DateTime(2023 - 07 - 07));
        $trip->setEnd(new \DateTime(2023 - 07 - 21));
        $trip->setTransportation("bus and plane");
        /*  dd($trip); */
        $em->persist($trip);
        $em->flush(); //INSERT INTO (name, itinerary, etc) VALUES ("", 30) and clicks GO
        /*  dd($trip); */
        return new Response("Trip has been created");
    }

    /**
     * @Route("/details/{id}", name="details page")
     */
    public function detailsAction(ManagerRegistry $doctrine, $id): Response
    {
        $trip = $doctrine->getRepository(Trips::class)->find($id);
        /*   dd($trips); */
        return $this->render('trips/details.html.twig', [
            "trips" => $trip
        ]);
    }
}
