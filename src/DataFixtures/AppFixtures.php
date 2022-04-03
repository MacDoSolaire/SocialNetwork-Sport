<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\EvenementLike;
use App\Entity\EvenementReply;
use App\Entity\Membre;
use App\Entity\ParticiperEvent;
use App\Entity\Publication;
use App\Entity\PublicationLike;
use App\Entity\PublicationReply;
use App\Factory\MembreFactory;
use App\Form\EvenementReplyType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\User;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $users = array();

        for ($i=0; $i < 20; $i++) {
            $user = new Membre();
            $user->setMail($faker->email)
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setVille('Reims')
                ->setCdPost(51100)
                ->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
            array_push($users, $user);
            $manager->persist($user);
        }

        for ($i=0; $i < 20; $i++) {
            $publi = new Publication();
            $publi->setDate(new \DateTime())
                ->setMessage($faker->text)
                ->setVisibilite(0)
                ->setSignalement(0)
                ->setMembre($faker->randomElement($users));
            $manager->persist($publi);

            for ($j=0; $j < mt_rand(0, 10); $j++) {
                $like = new PublicationLike();
                $like->setPublication($publi)
                    ->setMembre($faker->randomElement($users));
                $manager->persist($like);
            }

            for ($j=0; $j < mt_rand(0, 10); $j++) {
                $reply = new PublicationReply();
                $reply->setPublication($publi)
                    ->setMembre($faker->randomElement($users))
                    ->setDate(new \DateTime())
                    ->setMessage($faker->text);
                $manager->persist($reply);
            }
        }

        for ($i=0; $i < 10; $i++) {
            $event = new Evenement();
            $debDate = new \DateTime();
            $endDate = new \DateTime();
            $endDate->add(new \DateInterval('P' . mt_rand(0, 15) . 'D'));
            $debDate->sub(new \DateInterval('P' . mt_rand(0, 15) . 'D'));
            $event->setDateDeb($debDate)
                ->setDateFin($endDate)
                ->setAdresse($faker->address)
                ->setNbPers(mt_rand(2, 30))
                ->setMessage($faker->text)
                ->setVisibilite(0)
                ->setSignalement(0)
                ->setMembre($faker->randomElement($users));
            $manager->persist($event);

            for ($j=0; $j < mt_rand(0, 10); $j++) {
                $like = new EvenementLike();
                $like->setEvenement($event)
                    ->setMembre($faker->randomElement($users));
                $manager->persist($like);
            }

            for ($j=0; $j < mt_rand(0, 10); $j++) {
                $reply = new EvenementReply();
                $reply->setEvenement($event)
                    ->setMembre($faker->randomElement($users))
                    ->setDate(new \DateTime())
                    ->setMessage($faker->text);
                $manager->persist($reply);
            }

            for ($j=0; $j < mt_rand(0, $event->getNbPers()); $j++) {
                $participation = new ParticiperEvent();
                $participation->setEvenement($event)
                    ->setMembre($faker->randomElement($users));
                $manager->persist($participation);
            }
        }
        $manager->flush();
    }
}
