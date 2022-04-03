<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\PublicationLike;
use App\Entity\PublicationReply;
use App\Form\PublicationReplyType;
use App\Form\PublicationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
{
    /**
     * @Route("/publication" )
     */
    public function add(Request $request)
    {
        $publi = new Publication();
        $form = $this->createForm(PublicationType::class, $publi);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $publi->setDate(new \DateTime());
            $publi->setMembre($this->getUser());
            $publi->setSignalement(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($publi);
            $em->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render('index/addPublication.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/privee")
     */
    public function privee(Request $request){
        $privee = new Publication();
        $formPrivee = $this->createForm(PublicationType::class, $privee);

        $formPrivee->handleRequest($request);
        if ($formPrivee->isSubmitted() && $formPrivee->isValid()) {

            $privee->setDate(new \DateTime());
            $privee->setMembre($this->getUser());
            $privee->setSignalement(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($privee);
            $em->flush();

            return $this->redirectToRoute("indexPrivee");
        }

        return $this->render('index/addPublication.html.twig', [
            'form' => $formPrivee->createView()
        ]);
    }

    /**
     * @Route("/publication/{publicationId}/like", name="publication_like", requirements={"publicationId"="\d+"})
     * @return Response
     */
    public function like(int $publicationId) : Response {
        if (!$user = $this->getUser()) {
            return $this->json(['error' => 'Il faut etre connecter'], 403);
        }

        $publication = $this->getDoctrine()->getRepository(Publication::class)
            ->find($publicationId);

        if ($publication->isLikedByMember($user)) {
            $like = $this->getDoctrine()->getRepository(PublicationLike::class)
                ->findOneBy([
                    'publication' => $publication,
                    'membre' => $user
                ]);
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($like);
            $manager->flush();

            return $this->json([
                'nbLike' => $this->getDoctrine()->getRepository(PublicationLike::class)
                    ->count(['publication' => $publication])
            ], 200);
        }

        $like = new PublicationLike();
        $like->setMembre($user);
        $like->setPublication($publication);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($like);
        $manager->flush();

        return $this->json([
            'nbLike' => $this->getDoctrine()->getRepository(PublicationLike::class)
                ->count(['publication' => $publication])
        ], 200);
    }

    /**
     * @Route("/publication/{publicationId}/reply", name="publication_reply", requirements={"publicationId"="\d+"})
     * @return Response
     */
    public function reply(Request $request, int $publicationId) : Response {
        if (!$user = $this->getUser()) {
            $this->denyAccessUnlessGranted(['ROLE_USER']);
        }

        $publication = $this->getDoctrine()->getRepository(Publication::class)
            ->find($publicationId);

        $reply = new PublicationReply();
        $formReply = $this->createForm(PublicationReplyType::class, $reply);
        $formReply->handleRequest($request);

        if ($formReply->isSubmitted() && $formReply->isValid()) {
            $reply->setDate(new \DateTime());
            $reply->setMembre($this->getUser());
            $reply->setPublication($publication);

            $em = $this->getDoctrine()->getManager();
            $em->persist($reply);
            $em->flush();

            return $this->redirectToRoute('publication_reply', ['publicationId' => $publicationId]);
        }

        return $this->render('index/publicationDetail.html.twig', [
            'publication' => $publication,
            'replyForm' => $formReply->createView()
        ]);
    }
}