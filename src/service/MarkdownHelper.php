<?php


namespace App\service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    public $markDownParser;
    public $cache;
    public $isDebug;

    /**
     * MarkdownHelper constructor.
     */
    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache,
                                bool $isDebug)
    {
        $this->markDownParser = $markdownParser;
        $this->cache = $cache;
        $this->isDebug = $isDebug;

    }

    public function parse(string $source){
        //dd($this->isDebug);
            return $this->cache->get('markdown_'.md5($source),function() use ($source){
                   return $this->markDownParser->transformMarkdown($source);
            });
        }
}