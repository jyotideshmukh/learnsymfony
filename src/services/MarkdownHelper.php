<?php


namespace App\services;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    public $markDownParser;
    public $cache;

    /**
     * MarkdownHelper constructor.
     */
    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache)
    {
        $this->markDownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse(string $source){
            return $this->cache->get('markdown_'.md5($source),function() use ($source){
                   return $this->markDownParser->transformMarkdown($source);
            });
        }
}