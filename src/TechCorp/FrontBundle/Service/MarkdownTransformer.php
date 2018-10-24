<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 22/10/2018
 * Time: 18:47
 */

namespace TechCorp\FrontBundle\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser;

    public function __construct(MarkdownParserInterface $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parse($str)
    {
        return $this->markdownParser->transformMarkdown($str);
    }
}



