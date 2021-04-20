<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/")
     */


    public function homepage(){
        return new Response("Homepage");
    }

    /**
     * @Route("/question/{slug}")
     */

    public function show($slug){
        /*
         return new Response(sprintf(" My question is '%s'",
            str_replace("-"," ",$slug)));
        */
        $answers = [
            'Study hard',
            'practice it',
            'understand consepts'
        ];
        return $this->render('question/show.html.twig',
        [
            'question'=>str_replace("-"," ",$slug),
            'answers'=>$answers
        ]);


    }
}