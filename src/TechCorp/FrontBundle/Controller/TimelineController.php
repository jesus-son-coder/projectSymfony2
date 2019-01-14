<?php

namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechCorp\FrontBundle\Entity\Status;
use TechCorp\FrontBundle\Form\StatusType;

class TimelineController extends Controller
{
    public function timelineAction()
    {
        $em = $this->getDoctrine()->getManager();
        $statuses = $em->getRepository('TechCorpFrontBundle:Status')->getStatusesAndUsers(0)->getResult();
        return $this->render('TechCorpFrontBundle:Timeline:timeline.html.twig', array('statuses' => $statuses));
    }

    public function userTimelineAction($userId)
    {
        // 1) Récurérer l'utilisateur :
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TechCorpFrontBundle:User')->findOneById($userId);
        if(!$user) {
            $this->createNotFoundException("L'utilisateur n'a pas été trouvé.");
        }

        // 2) Créer le Formulaire :
        $authenticatedUser = $this->get('security.context')->getToken()->getUser(); 
        $status = new Status();
        $status->setDeleted(false);
        $status->setUser($authenticatedUser); // die('là!');

        $form = $this->createForm(new StatusType(), $status);
        $request = $this->get('request_stack')->getCurrentRequest();

        $form->handleRequest($request);

        // 3) Traiter le formulaire :
        if($authenticatedUser && $form->isValid()) {
            $em->persist($status);
            $em->flush();
            $this->redirect($this->generateUrl('tech_corp_front_user_timeline', array(
                'userId' => $authenticatedUser->getId()
            )));
        }

        // 4) Récupérer les statuts :
        $statuses = $em->getRepository('TechCorpFrontBundle:Status')->getUserTimeline($user)->getResult();

        // 5) Rendre la page :
        return $this->render('TechCorpFrontBundle:Timeline:user_timeline.html.twig', array(
            'user' => $user,
            'statuses' => $statuses,
            'form' => $form->createView(),
        ));
    }

    public function friendsTimelineAction($userId)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('TechCorpFrontBundle:User')->findOneBy(array('id' => $userId));
        if(!$user){
            $this->createNotFoundException("L'utilisateur n'a pas été trouvé.");
        }
        $statuses = $em->getRepository('TechCorpFrontBundle:Status')->getFriendsTimeline($user)->getResult();

        return $this->render('TechCorpFrontBundle:Timeline:friends_timeline.html.twig', array(
            'user' => $user,
            'statuses' => $statuses,
        ));
    }


}
