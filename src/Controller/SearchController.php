<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\SearchPublicationType;
use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route ("/search", name="search_publication")
     * @param Request $request
     * @param $publicationRepository
     * @return Response
     */
    public function searchPublication(Request $request, PublicationRepository $publicationRepository){

        $recherche = [];

        $searchPubForm = $this->createForm(SearchPublicationType::class);

        $searchPubForm->handleRequest($request);
        if ($searchPubForm->isSubmitted() && $searchPubForm->isValid()) {
            $recherche = $publicationRepository->searchPubli($searchPubForm->getData());
        }
        return $this->render('Barre/search.html.twig', [
            'search_form' => $searchPubForm->createView(),
            'res' => $recherche,
        ]);
    }
}