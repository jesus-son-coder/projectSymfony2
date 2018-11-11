<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 08/11/2018
 * Time: 06:25
 */

namespace AppBundle\Form\Handler;


use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class SheetHandler
{
    protected $form;
    protected $request;
    protected $em;

    /**
     * SheetHandler constructor.
     * @param Form $form
     * @param Request $request
     */
    public function __construct(Form $form, Request $request, EntityManager $em)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }
    // ...
    /**
     * @return bool
     */
    public function process()
    {
        $this->form->handleRequest($this->request);

        if($this->request->isMethod('post') && $this->form->isValid()){
            $this->onSuccess();
            return true;
        }
        return false;
    }

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    protected function onSuccess()
    {
        $this->em->persist($this->form->getData());
        $this->em->flush();
    }

}