<?php


namespace App\service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Sentry\State\HubInterface;
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
                                bool $isDebug, HubInterface $hub)
    {
        $this->markDownParser = $markdownParser;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
        //dd($hub);

    }

    public function parse(string $source){
        //dd($this->isDebug);
        if(!$this->isDebug){
            return $this->markDownParser->transformMarkdown($source);
        }
        //throw new \Exception("Bad stuff happened");
            return $this->cache->get('markdown_'.md5($source),function() use ($source){
                   return $this->markDownParser->transformMarkdown($source);
            });
    }
}