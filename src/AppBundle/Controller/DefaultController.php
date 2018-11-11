<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /*
        return $this->render('default/city.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        )); */
        // return $this->render('default/city.html.twig');
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Ville')
        ;

        $villes = $repository->findAll();

        return $this->render('AppBundle:Default:index.html.twig', array(
            'villes' => $villes
        ));
    }

    public function rechercheAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $mot_cle = $request->request->get('mot_cle');
            if(!empty($mot_cle))
            {
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('AppBundle:Ville')
                    ;

                $villes = $repository->findByName($mot_cle);
                //print_r($villes);die();
            }
            return $this->render('AppBundle:default:city.html.twig', array(
                'villes' => $villes
            ));
        }
    }

    public function villeAction($id)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Ville')
        ;

        $ville = $repository->findOneById($id); // dump($ville);die();

        return $this->render('AppBundle:default:ville.html.twig', array(
            'ville' => $ville
        ));
    }
}



