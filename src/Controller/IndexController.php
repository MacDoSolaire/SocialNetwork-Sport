<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Publication;
use App\Entity\PublicationLike;
use App\Entity\PublicationReply;
use App\Form\PublicationReplyType;
use App\Form\PublicationType;
use App\Repository\LikeRepository;
use App\Repository\PublicationLikeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index() : Response
    {
        if ($this->getUser()) {
            // Récuperation des publications
            $publications = $this->getDoctrine()->getRepository(Publication::class);
            $tab_publi = $publications->findBy(array('visibilite' => 0),array('id' => 'desc'));

            //Récuperation des évenements
            $event = $this->getDoctrine()->getRepository(Evenement::class);
            $tab_event = $event->findBy(array(), array('id' => 'desc'));

            $tabFinal = array();
            foreach ($tab_publi as $publication) { array_push($tabFinal, $publication); }
            foreach ($tab_event as $evenement) { array_push($tabFinal, $evenement); }

            // Tri des evenements et publications par ordre decroissant de date
            usort($tabFinal, function ($a, $b) {
                if ($a instanceof Publication) {
                    if ($b instanceof Evenement) {
                        return ($b->getDateDeb() < $a->getDate()) ? -1 : 1;
                    }
                    return ($b->getDate() < $a->getDate()) ? -1 : 1;
                }

                if ($a instanceof Evenement) {
                    if ($b instanceof Publication) {
                        return ($b->getDate() < $a->getDateDeb()) ? -1 : 1;
                    }
                    return ($b->getDateDeb() < $a->getDateDeb()) ? -1 : 1;
                }
            });

            return $this->render('index/index.html.twig', array('tabPubliEvent' => $tabFinal));
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);
    }

    /**
     * @Route("/indexPrivee", name="indexPrivee")
     */
    public function indexPrivee() : Response
    {
        if ($this->getUser()) {
            // Récuperation des publications
            $publications = $this->getDoctrine()->getRepository(Publication::class);
            $tab_publi = $publications->findBy(array('visibilite' => 1),array('id' => 'desc'));

            //Récuperation des évenements
            $event = $this->getDoctrine()->getRepository(Evenement::class);
            $tab_event = $event->findBy(array(), array('id' => 'desc'));

            $tabFinal = array();
            foreach ($tab_publi as $publication) { array_push($tabFinal, $publication); }
            foreach ($tab_event as $evenement) { array_push($tabFinal, $evenement); }

            // Tri des evenements et publications par ordre decroissant de date
            usort($tabFinal, function ($a, $b) {
                if ($a instanceof Publication) {
                    if ($b instanceof Evenement) {
                        return ($b->getDateDeb() < $a->getDate()) ? -1 : 1;
                    }
                    return ($b->getDate() < $a->getDate()) ? -1 : 1;
                }

                if ($a instanceof Evenement) {
                    if ($b instanceof Publication) {
                        return ($b->getDate() < $a->getDateDeb()) ? -1 : 1;
                    }
                    return ($b->getDateDeb() < $a->getDateDeb()) ? -1 : 1;
                }
            });

            return $this->render('index/indexPrivee.html.twig', array('tabPubliEvent' => $tabFinal));
        }
        $this->denyAccessUnlessGranted(['ROLE_USER']);
    }
}