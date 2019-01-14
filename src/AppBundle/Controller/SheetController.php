<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 06/11/2018
 * Time: 23:33
 */

namespace AppBundle\Controller;

use AppBundle\Form\EditorType;
use AppBundle\Form\Handler\SheetHandler;
use AppBundle\Form\SheetType;
use Doctrine\ORM\EntityNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Sheet;
use AppBundle\Entity\Editor;

class SheetController extends Controller
{
    public function showAction($id, Request $request)
    {
        $request->isXmlHttpRequest(); // Ajax ?
        $request->getPreferredLanguage(array('en', 'fr'));
        $request->query->get('page');   // $_GET
        $request->request->get('page'); // $_POST



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

    public function editorAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $article = new Editor();
        $articles = $em->getRepository('AppBundle:Editor')->findAll();

        $form = $this->createForm(new EditorType(), $article);
        $request = $this->get('request_stack')->getCurrentRequest();

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('front_sheet_ckeditor_list');
        }

        return $this->render('AppBundle:sheet:editor.html.twig', array(
                'form' => $form->createView(),
                'articles' => $articles
            )
        );
    }

    public function modifiereditorAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('AppBundle:Editor')->findOneById($id);
        $articles = $em->getRepository('AppBundle:Editor')->findAll();
        $form = $this->createForm(new EditorType(), $article);
        $request = $this->get('request_stack')->getCurrentRequest();

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('front_sheet_ckeditor_list');
        }

        return $this->render('AppBundle:sheet:editor.html.twig', array(
                'form' => $form->createView(),
                'article' => $article
            )
        );
    }

    public function listeditorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Editor')->findAll();

        return $this->render('AppBundle:sheet:listeditor.html.twig', array(
                'articles' => $articles
            )
        );
    }


}