<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
       // return new Response("Homepage");
        return $this->render('question/homepage.html.twig',
        ['questions'=>$questions]);
    }

    /**
     * @Route("/question/{slug}",name="app_question_answer")
     */

    public function show($slug){
        /*
         return new Response(sprintf(" My question is '%s'",
            str_replace("-"," ",$slug)));
        */
        $answers = [
            'Study hard',
            'practice it',
            'understand concepts'
        ];
        return $this->render('question/show.html.twig',
        [
            'question'=>str_replace("-"," ",$slug),
            'answers'=>$answers
        ]);


    }
}