<?php


namespace App\Controller;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Twig\Environment;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */


    public function homepage(){
        $questions = [
            'How to pass devops',
            'How to be safe in pandemic',
            'How to increase hemoglobin'
        ];
       /* $html = $twigEnvironment->render('question/homepage.html.twig',
            ['questions'=>$questions]);
        return new Response($html);*/
       // return new Response("Homepage");
        return $this->render('question/homepage.html.twig',
        ['questions'=>$questions]);
    }

    /**
     * @Route("/question/{slug}",name="app_question_answer")
     */

    public function show($slug, MarkdownParserInterface $markdownParser, CacheInterface $cache){
        /*
         return new Response(sprintf(" My question is '%s'",
            str_replace("-"," ",$slug)));
        */
        $answers = $cache->get('answers',function() use ($markdownParser){
            $answers = [
                $markdownParser->transformMarkdown('**Study hard**'),
                $markdownParser->transformMarkdown('**practice** it'),
                $markdownParser->transformMarkdown('**understand** concepts')
            ];
            return $answers;
        });
        //dd($markdownParser);


        return $this->render('question/show.html.twig',
        [
            'question'=>str_replace("-"," ",$slug),
            'answers'=>$answers
        ]);


    }
}