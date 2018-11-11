<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Booking;
use AppBundle\Form\BookingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller
{
    public function indexAction(Request $request)
    {
        $booking = new Booking();

        /*
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Booking')
        ;
        $bookings = $repository->findAll();
        */

        $form = $this->createForm(new BookingType(), $booking);

        return $this->render('AppBundle:Booking:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}



