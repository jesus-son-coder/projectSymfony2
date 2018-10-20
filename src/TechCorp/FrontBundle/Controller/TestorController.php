<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 20/10/2018
 * Time: 17:49
 */

namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechCorp\FrontBundle\Entity\Status;
use TechCorp\FrontBundle\Form\StatusType;

class TestorController extends Controller
{
    public function indexAction()
    {
        $laLocale = $this->container->getParameter('locale');
        // die($laLocale);

        $em = $this->container->get('doctrine')->getManager();
        $repository = $em->getRepository('TechCorp\FrontBundle\Entity\Status');
        $statuses = $repository->findAll();

        // Créer une instance d'entité sans "Use" pour importer la classe :
        $user = new \TechCorp\FrontBundle\Entity\User();
        $price = 11.31;

        return $this->render('TechCorpFrontBundle:Testor:index.html.twig',
            array('listStatuses' => $statuses,
                'price' => $price));
    }
}