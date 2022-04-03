<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Amitie;
use App\Entity\Membre;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AmisController extends AbstractController
{
    /**
     * @Route("amis/add/{membreId}", name="add_amis", requirements={"membreId"="\d+"})
     * @return Response
     */
    public function addFriend(int $membreId) : Response {
        if ($user = $this->getUser()) {
            $membreReceive = $this->getDoctrine()->getRepository(Membre::class)
                ->find($membreId);

            $amitie = new Amitie();
            $amitie->setDate(new \DateTime())
                ->setMembreSender($user)
                ->setMembreReceiver($membreReceive)
                ->setStatus('E');

            return $this->json([
                'status' => 'E'
            ], 200);
        }
    }

    /**
     * @Route("amis/accept/{membreId}", name="accept_amis", requirements={"membreId"="\d+"})
     * @return Response
     */
    public function acceptFriend(int $membreId) : Response {
        if ($user = $this->getUser()) {
            $membreReceive = $this->getDoctrine()->getRepository(Membre::class)
                ->find($membreId);

            $amitie = $this->getDoctrine()->getRepository(Amitie::class)
                ->findOneBy(['membreSender' => $user, 'membreReceiver' => $membreReceive]);

            $amitie->setStatus('A')
                ->setDate(new \DateTime());

            return $this->json([
                'status' => 'A'
            ], 200);
        }
    }

    /**
     * @Route("amis/deny/{membreId}", name="deny_amis", requirements={"membreId"="\d+"})
     * @return Response
     */
    public function denyFriend(int $membreId) : Response {
        if ($user = $this->getUser()) {
            $membreReceive = $this->getDoctrine()->getRepository(Membre::class)
                ->find($membreId);

            $amitie = $this->getDoctrine()->getRepository(Amitie::class)
                ->findOneBy(['membreSender' => $user, 'membreReceiver' => $membreReceive]);

            $amitie->setStatus('R')
                ->setDate(new \DateTime());

            return $this->json([
                'status' => 'A'
            ], 200);
        }
    }
}