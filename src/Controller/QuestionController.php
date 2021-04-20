<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
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
        return new Response(sprintf(" My question is '%s'",
            str_replace("-"," ",$slug)));

    }
}