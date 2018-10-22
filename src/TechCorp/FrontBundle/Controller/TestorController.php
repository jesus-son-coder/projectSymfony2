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

class TestorController extends Controller
{
    public function indexAction()
    {
        $cache = $this->get('markdown_cache');

        $someMarkdown = "Je suis du *super* code **MarkDown**";

        $key = 'mykey6553';
        if($cache->contains($key)){
            $someMarkdownTransformed = $cache->fetch($key);
        } else {
            sleep(2);
            $someMarkdownTransformed = $this->container->get('markdown.parser')->transformMarkdown($someMarkdown);
            $cache->save($key, $someMarkdownTransformed);
        }

        return $this->render('TechCorpFrontBundle:Testor:index.html.twig',
            array('someMarkdown' => $someMarkdownTransformed)
        );

    }

    public function cacheManagerAction()
    {
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');

        $someMarkdown = "Je suis du *super* code **MarkDown**";
        $key = md5($someMarkdown);

        if($cache->contains($key)){
            $someMarkdownTransformed = $cache->fetch($key);
        } else {
            sleep(1);
            $someMarkdownTransformed = $this->container->get('markdown.parser')->transformMarkdown($someMarkdown);
            $cache->save($key, $someMarkdownTransformed);
        }

        return $this->render('TechCorpFrontBundle:Testor:index.html.twig',
            array('someMarkdown' => $someMarkdownTransformed)
        );
    }
}