<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EvenementLike;
use App\Entity\EvenementReply;
use App\Entity\ParticiperEvent;
use App\Entity\Publication;
use App\Entity\PublicationLike;
use App\Entity\PublicationReply;
use App\Form\EvenementReplyType;
use App\Form\EvenementType;
use App\Form\PublicationReplyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement" )
     */
    public function add(Request $request)
    {
        $event = new Evenement();
        $form = $this->createForm(EvenementType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event->setMembre($this->getUser());
            $event->setSignalement(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render('index/addEvenement.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/evenement/{evenementId}/like", name="evenement_like", requirements={"evenementId"="\d+"})
     * @return Response
     */
    public function like(int $evenementId) : Response {
        if (!$user = $this->getUser()) {
            return $this->json(['error' => 'Il faut etre connecter'], 403);
        }

        $event = $this->getDoctrine()->getRepository(Evenement::class)
            ->find($evenementId);

        if ($event->isLikedByMember($user)) {
            $like = $this->getDoctrine()->getRepository(EvenementLike::class)
                ->findOneBy([
                    'evenement' => $event,
                    'membre' => $user
                ]);
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($like);
            $manager->flush();

            return $this->json([
                'nbLike' => $this->getDoctrine()->getRepository(EvenementLike::class)
                    ->count(['evenement' => $event])
            ], 200);
        }

        $like = new EvenementLike();
        $like->setMembre($user);
        $like->setEvenement($event);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($like);
        $manager->flush();

        return $this->json([
            'nbLike' => $this->getDoctrine()->getRepository(EvenementLike::class)
                ->count(['evenement' => $event])
        ], 200);
    }

    /**
     * @Route("/evenement/{evenementId}/reply", name="evenement_reply", requirements={"evenementId"="\d+"})
     * @return Response
     */
    public function reply(Request $request, int $evenementId) : Response {
        if (!$user = $this->getUser()) {
            $this->denyAccessUnlessGranted(['ROLE_USER']);
        }

        $evenement = $this->getDoctrine()->getRepository(Evenement::class)
            ->find($evenementId);

        $reply = new EvenementReply();
        $formReply = $this->createForm(EvenementReplyType::class, $reply);
        $formReply->handleRequest($request);

        if ($formReply->isSubmitted() && $formReply->isValid()) {
            $reply->setDate(new \DateTime());
            $reply->setMembre($this->getUser());
            $reply->setEvenement($evenement);

            $em = $this->getDoctrine()->getManager();
            $em->persist($reply);
            $em->flush();

            return $this->redirectToRoute('evenement_reply', ['evenementId' => $evenementId]);
        }

        return $this->render('index/evenementDetail.html.twig', [
            'evenement' => $evenement,
            'replyForm' => $formReply->createView()
        ]);
    }

    /**
     * @Route("/evenement/{evenementId}/join", name="evenement_join", requirements={"evenementId"="\d+"})
     * @return Response
     */
    public function join(int $evenementId) : Response {
        if (!$user = $this->getUser()) {
            return $this->json(['error' => 'Il faut etre connecter'], 403);
        }

        $evenement = $this->getDoctrine()->getRepository(Evenement::class)
            ->find($evenementId);

        if ($evenement->isMemberParticipating($user)) {
            $participation = $this->getDoctrine()->getRepository(ParticiperEvent::class)
                ->findOneBy([
                    'evenement' => $evenement,
                    'membre' => $user
                ]);
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($participation);
            $manager->flush();

            return $this->json([
                'nbParticipation' => $this->getDoctrine()->getRepository(ParticiperEvent::class)
                    ->count(['evenement' => $evenement])
            ], 200);
        }

        $nbParticipation = $this->getDoctrine()->getRepository(ParticiperEvent::class)
            ->count(['evenement' => $evenement]);

        if ($nbParticipation < $evenement->getNbPers()) {
            $participation = new ParticiperEvent();
            $participation->setMembre($user);
            $participation->setEvenement($evenement);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($participation);
            $manager->flush();

            return $this->json([
                'nbParticipation' => $this->getDoctrine()->getRepository(ParticiperEvent::class)
                    ->count(['evenement' => $evenement])
            ], 200);
        }

        return $this->json([
            'nbParticipation' => $this->getDoctrine()->getRepository(ParticiperEvent::class)
                ->count(['evenement' => $evenement])
        ], 200);
    }
}