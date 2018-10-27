<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 22/10/2018
 * Time: 18:47
 */

namespace TechCorp\FrontBundle\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Doctrine\Common\Cache\CacheProvider;

class MarkdownTransformer
{
    private $markdownParser;
    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, CacheProvider $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse($str)
    {
        $key = md5($str);

        if($this->cache->contains($key)){
            return $this->cache->fetch($key);
        } else {
            $str = $this->markdownParser->transformMarkdown($str);
            $this->cache->save($key, $str);
            return $str;
        }

    }
}



