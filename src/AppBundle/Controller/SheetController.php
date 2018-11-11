<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 06/11/2018
 * Time: 23:33
 */

namespace AppBundle\Controller;

use AppBundle\Form\Handler\SheetHandler;
use AppBundle\Form\SheetType;
use Doctrine\ORM\EntityNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Sheet;

class SheetController extends Controller
{
    public function showAction($id, Request $request)
    {
        // Gérer la Session utilisateur :
        $session = $this->get('session');
        $session->set('machin', 'valeur');
        $session->getFlashBag()->add('success', 'bravo !');

        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Sheet');
        $sheet = $repository->find($id);

        if(!$sheet) {
            throw new EntityNotFoundException();
        }
        return $this->render('AppBundle:Sheet:show.html.twig', array('sheet' => $sheet));
    }

    public function createAction(Request $request)
    {
        //$sheet = new Sheet();
        //$form = $this->createForm( new SheetType(), $sheet);
        $formHandler = $this->get('sheet_handler');

        if($formHandler->process()){
            return $this->redirect($this->generateUrl('front_sheet_create'));
        }
        return $this->render('AppBundle:Sheet:create.html.twig', array(
            'form' => $formHandler->getForm()->createView()
        ));
    }


}