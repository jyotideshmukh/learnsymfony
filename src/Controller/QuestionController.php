<?php


namespace App\Controller;


use App\service\MarkdownHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
#use Twig\Environment;

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

    public function show($slug, MarkdownHelper $markdownHelper){
        /*
         return new Response(sprintf(" My question is '%s'",
            str_replace("-"," ",$slug)));
        */

            $answers = [
                $markdownHelper->parse('**Study hard**'),
                $markdownHelper->parse('**practice** it'),
                $markdownHelper->parse('**understand** concepts')
            ];

        //dd($markdownParser);



        return $this->render('question/show.html.twig',
        [
            'question'=>str_replace("-"," ",$slug),
            'answers'=>$answers
        ]);


    }
}