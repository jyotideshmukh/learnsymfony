<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    /**
     * @Route("/comments/{id}/vote/{direction}")
     * @param $id
     * @param $direction
     * @return JsonResponse
     */
    public function vote($id, $direction){

        if($direction == 'up'){
            return new JsonResponse(['vote'=>rand(7,100)]);
        }
        else{
            return new JsonResponse(['vote'=>rand(0,5)]);
        }
    }

}