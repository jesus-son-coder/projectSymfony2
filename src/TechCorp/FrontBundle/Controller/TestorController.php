<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 20/10/2018
 * Time: 17:49
 */

namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use TechCorp\FrontBundle\Entity\Status;
use TechCorp\FrontBundle\Form\StatusType;
use TechCorp\FrontBundle\Service\MarkdownTransformer;

class TestorController extends Controller
{
    public function indexAction()
    {
        $someMarkdown = "Je suis du *super* code **MarkDown**";

        $transformer = $this->get('app.markdown_transformer');

        $someMarkdownTransformed = $transformer->parse($someMarkdown);

        return $this->render('TechCorpFrontBundle:Testor:index.html.twig',
            array('someMarkdown' => $someMarkdownTransformed)
        );

    }


    public function markdownManager()
    {
        $someMarkdown = "Je suis du *super* code **MarkDown**";

        $transformer = $this->get('app.markdown_transformer');

        $someMarkdownTransformed = $transformer->parse($someMarkdown);

        return $this->render('TechCorpFrontBundle:Testor:index.html.twig',
            array('someMarkdown' => $someMarkdownTransformed)
        );
    }


    public function cacheManagerAction()
    {
        $cache = $this->get('markdown_cache');
        $someMarkdown = "Je suis du *super* code **MarkDown**";
        $key = md5($someMarkdown);

        if($cache->contains($key)){
            $someMarkdownTransformed = $cache->fetch($key);
        } else {
            // sleep(1);
            $someMarkdownTransformed = $this->container->get('markdown.parser')->transformMarkdown($someMarkdown);
            $cache->save($key, $someMarkdownTransformed);
        }

        return $this->render('TechCorpFrontBundle:Testor:index.html.twig',
            array('someMarkdown' => $someMarkdownTransformed)
        );
    }

    public function cacheManagerSimplifieAction()
    {
        // Cette émthode utilise le Service "app.markdown_transformer" que nous avons créé de toute pièce pour effectuer les mêmes tâches que dans la méthode précédente :

        $cache = $this->get('markdown_cache');

        $someMarkdown = "Je suis du *super* code **MarkDown**";

        // Appel de notre méthode personnalisée "app.markdown_transformer" :
        $someMarkdown = $this->get('app.markdown_transformer')->parse($someMarkdown);

        return $this->render('TechCorpFrontBundle:Testor:index.html.twig',
            array('someMarkdown' => $someMarkdown)
        );
    }

}