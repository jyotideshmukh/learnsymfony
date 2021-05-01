<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       /* $question = new Question();
        $question->setName('Learn Fixures');
        $question->setSlug('learn-fixures-'.rand(1,1000));
        $question->setQuestion('How to learn Fixures- using orm-fixures?');
        if(rand(1,10)> 2){
            $question->setAskedAt(new \DateTime());
        }
         $manager->persist($question);*/

        QuestionFactory::new()->createMany(20);
        QuestionFactory::new()->unPublished()->createMany(5);
        $manager->flush();

        $manager->flush();
    }
}
