<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil" )
     */
    public function Accueil(): Response
    {

        return $this->render('authentication/accueil.html.twig');
    }
    /**
     * @Route("accueil/register")
     */
    public function new(): Response
    {
        return $this->render('authentication/register.html.twig');
    }



}