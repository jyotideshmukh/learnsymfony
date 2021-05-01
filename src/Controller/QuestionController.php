<?php


namespace App\Controller;


use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#use Twig\Environment;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage( QuestionRepository $questionRepository){
        $questions = $questionRepository->findAllByAskedAtDesc();
        /*$repository = $entityManager->getRepository(Question::class);
        $questions = $repository->findAll();*/
        /*foreach($questions as $question){
            $questionsArr[] = $question->getSlug();
        }*/
        //$questions = $questionsArr;
        /*$questions = [
            'How to pass devops',
            'How to be safe in pandemic',
            'How to increase hemoglobin'
        ];*/
       /* $html = $twigEnvironment->render('question/homepage.html.twig',
            ['questions'=>$questions]);
        return new Response($html);*/
       // return new Response("Homepage");
        return $this->render('question/homepage.html.twig',
        ['questions'=>$questions]);
    }

    /**
     * @Route("/questions/new")
     */
    public function new(EntityManagerInterface $entityManager){
        $question = new Question();
        $question->setName('Devops preparation');
        $question->setSlug('devops-preparation-'.rand(1,1000));
        $question->setQuestion('How to pass Devops?');
        if(rand(1,10)> 2){
            $question->setAskedAt(new \DateTime());
        }
        $entityManager->persist($question);
        $entityManager->flush();
        return new Response(sprintf('question id is %d and question slug is %s',
            $question->getId(),$question->getSlug()));
    }

    /**
     * @Route("/questions/{slug}",name="app_question_answer")
     */

    public function show(Question $question, MarkdownHelper $markdownHelper){
        /*
         return new Response(sprintf(" My question is '%s'",
            str_replace("-"," ",$slug)));
        */

        //$repository = $entityManager->getRepository(Question::class);
        /**  var Question|null $question */
        //$question = $repository->findOneBy(['slug'=>$slug]);
       /* $question = $questionRepository->findOneBy(['slug'=>$slug]);*/
        if(!$question){
            $request = Request::createFromGlobals();
            throw $this->createNotFoundException(
                sprintf('Given slug not found "%s"', $request->query->get('slug'))
            );
        }
            $answers = [
                $markdownHelper->parse('**Study hard**'),
                $markdownHelper->parse('**practice** it'),
                $markdownHelper->parse('**understand** concepts')
            ];

        //dd($markdownParser);



        return $this->render('question/show.html.twig',
        [
           // 'question'=>str_replace("-"," ",$slug),
            'question'=>$question,
            'answers'=>$answers
        ]);


    }

    /**
     * @Route("/questions/{slug}/vote", name="app_question_vote", methods="POST")
     */
    public function questionVote(Question $question, Request $request,EntityManagerInterface $entityManager){
     //dd($question);
     //dd($request->request->all() );
        $direction = $request->request->get('direction');
        if ($direction === 'up') {
            //$question->setVotes($question->getVotes() + 1);
            $question->upVote();
        } elseif ($direction === 'down') {
           // $question->setVotes($question->getVotes() - 1);
            $question->downVote();
        }
        $entityManager->flush();
       return $this->redirectToRoute('app_question_answer',
           ['slug'=>$question->getSlug()]
       );
    }
}