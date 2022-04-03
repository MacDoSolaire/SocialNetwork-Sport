<?php
declare(strict_types=1);

namespace App\Controller;


use App\Entity\Amitie;
use App\Entity\Membre;
use App\Entity\Publication;
use App\Form\MembreType;
use App\Form\PublicationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{membreId}", name="profil", requirements={"membreId"="\d+"})
     */
    public function profil(int $membreId) : Response
    {

        if ($user = $this->getUser()) {
            $membre= $this->getDoctrine()->getRepository(Membre::class)
                ->find($membreId);

        }
        return $this->render('profil/profil.html.twig',['utilisateur' =>$membre]);
    }
    /**
     * @Route("/profil/{membreId}/publication", name="profil_publication", requirements={"membreId"="\d+"})
     */
    public function profil_publication(int $membreId) : Response
    {

        if ($user = $this->getUser()) {
            $membre= $this->getDoctrine()->getRepository(Membre::class)
                ->find($membreId);
            $publications = $this->getDoctrine()->getRepository(Publication::class);
            $publi_profil = $publications->findBy(["membre"=>$membre]);

            $publications = $this->getDoctrine()->getRepository(Membre::class);
            $utilisateur = $publications->findBy(["id"=>$membre]);

        }
        return $this->render('profil/publication.html.twig',['publi_profil' =>$publi_profil,'utilisateur' =>$membre]);
    }

    /**
     * @Route("/profil/{membreId}/ami", name="profil_ami", requirements={"membreId"="\d+"})
     */
    public function profil_ami(int $membreId) : Response
    {

        if ($user = $this->getUser()) {
            $membre= $this->getDoctrine()->getRepository(Membre::class)
                ->find($membreId);
            $ami = $this->getDoctrine()->getRepository(Amitie::class);
            $amis = $ami->findBy(["membre"=>$membre]);

            $membre= $this->getUser()->getId();
            $publications = $this->getDoctrine()->getRepository(Membre::class);
            $utilisateur = $publications->findBy(["id"=>$membre]);

        }
        return $this->render('profil/ami.html.twig',['amis' =>$amis, 'utilisateur' =>$utilisateur]);
    }

    /**
     * @Route("/profil/param", name="profil_param")
     */
    public function param(Request $request):Response
    {
        $param = $this->getUser();
        $form = $this->createForm(MembreType::class, $param);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($param);
            $em->flush();

            return $this->redirectToRoute("profil", ['membreId' => $this->getUser()->getId()]);
        }

        return $this->render('profil/modif.html.twig', [
            'form' => $form->createView()
        ]);
    }


}