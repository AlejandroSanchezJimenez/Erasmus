<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Entity\Convocatoria;
use App\Repository\CandidatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConvocatoriasController extends AbstractController
{
    private $security;
    private $user;

    public function __construct(Security $security, CandidatoRepository $user)
    {
        $this->security = $security;
        $this->user = $user;
    }

    #[Route('/convocatorias/form', name: 'app_formconvo')]
    public function expanded(): Response
    {
        $dni = $this->security->getUser()->getUserIdentifier();
        $candidato = $this->user->findOneBy(['DNI' => $dni]);

        return $this->render('convocatorias/form.html.twig', [
            'candidato' => $candidato,
        ]);
    }

    #[Route('/convocatorias', name: 'app_convocatorias')]
    public function index(): Response
    {
        return $this->render('convocatorias/index.html.twig', [
            'controller_name' => 'ConvocatoriasController',
        ]);
    }

    #[Route('/convocatorias/new', name: 'app_newconvo')]
    public function newForm(): Response
    {
        return $this->render('convocatorias/new.html.twig', [
            'controller_name' => 'ConvocatoriasController',
        ]);
    }
}
