<?php

namespace App\Twig;

use App\service\MarkdownHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MarkdownTwigExtentionExtension extends AbstractExtension
{

    public $markdownHelper;
    /**
     * MarkdownTwigExtentionExtension constructor.
     */
    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('parse_markdown', [$this, 'parseMarkdown']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('parse_markdown', [$this, 'parseMarkdown']),
        ];
    }

    public function parseMarkdown($value)
    {
        // ...
        return $this->markdownHelper->parse($value);
    }
}
