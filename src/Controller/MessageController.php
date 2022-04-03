<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Membre;
use App\Entity\MessagePrive;
use App\Form\MessagePriveType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MessageController extends AbstractController
{
    /**
     * @Route("/messages", name="messages")
     * @return Response
     */
    public function loadConversations(): Response
    {
        if ($user = $this->getUser()) {
            $allMessages = $this->getDoctrine()->getRepository(Conversation::class)
                ->findAll();
            return $this->render('messages/conversations.html.twig', array('conversations' => $allMessages));
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);
    }

    /**
     * @Route("/messages/new/{membreId}", name="create_conversation", requirements={"membreId"="\d+"})
     * @return Response
     */
    public function createConversationWith(Request $request, int $membreId): Response
    {
        if ($user = $this->getUser()) {
            $conversation = new Conversation();
            $conversation->setDateCreation(new \DateTime());

            $membre = $this->getDoctrine()->getRepository(Membre::class)
                ->find($membreId);

            $conversation->addMembre($user);
            $conversation->addMembre($membre);
            $conversation->setTitre($membre->getNom() .' '. $membre->getPrenom());

            $em = $this->getDoctrine()->getManager();
            $em->persist($conversation);
            $em->flush();

            return new RedirectResponse("/messages");
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);
    }

    /**
     * @Route("/messages/{conversationId}", name="load_conversation", requirements={"conversationId"="\d+"})
     * @return Response
     */
    public function loadMessagesInConversation(Request $request, int $conversationId): Response
    {
        if ($user = $this->getUser()) {
            $conversation = $this->getDoctrine()->getRepository(Conversation::class)->find(
                $conversationId
            );

            $message = new MessagePrive();
            $messageForm = $this->createForm(MessagePriveType::class, $message);
            $messageForm->handleRequest($request);

            if ($messageForm->isSubmitted() && $messageForm->isValid()) {
                $message->setDate(new \DateTime());
                $message->setMembre($this->getUser());

                $conversation = $this->getDoctrine()->getRepository(Conversation::class)->find(
                    $conversationId
                );
                $conversation->addMessage($message);

                $em = $this->getDoctrine()->getManager();
                $em->persist($message);
                $em->flush();

                return $this->redirectToRoute('load_conversation', ['conversationId' => $conversationId]);
            }

            return $this->render('messages/conversation.html.twig', [
                'conversation' => $conversation,
                'msgForm' => $messageForm->createView()
            ]);
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);
    }
}