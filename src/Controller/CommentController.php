<?php


namespace App\Controller;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    /**
     * @Route("/comments/{id<\d+>}/vote/{direction<up|down>}", methods="POST")
     * @param $id
     * @param $direction
     * @return JsonResponse
     */
    public function vote($id, $direction, LoggerInterface $logger){

        if($direction == 'up'){
            $logger->info('voting up');
            return new JsonResponse(['vote'=>rand(7,100)]);
        }
        else{
            $logger->info('voting down');
            return new JsonResponse(['vote'=>rand(0,5)]);
        }
    }

}