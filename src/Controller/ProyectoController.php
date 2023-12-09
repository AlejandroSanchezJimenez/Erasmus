<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Repository\ProyectoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProyectoController extends AbstractController
{
    private $security;
    private $proRep;

    public function __construct(Security $security, ProyectoRepository $proRep)
    {
        $this->security = $security;
        $this->proRep = $proRep;
    }

    #[Route('/proyectos', name: 'app_proyecto')]
    public function index(): Response
    {
        $rol = $this->security->getUser()->getRoles();
        $proyectos = $this->proRep->findAll();
        return $this->render('proyecto/index.html.twig', [
            'proyectos' => $proyectos,
            'rol' => $rol
        ]);
    }

    #[Route('/proyectos/new', name: 'app_proyecto_new')]
    public function new(): Response
    {
        return $this->render('proyecto/new.html.twig', [
            'controller_name' => 'ProyectoController',
        ]);
    }

    #[Route('/proyectos/api', name: 'app_proyectos_api_getAll', methods: ['GET'])]
    public function getAllProyectos(ProyectoRepository $ProRep): JsonResponse
    {
        $des = $ProRep->findAll();
        $data = [];

        foreach ($des as $des) {
            $data[] = [
                'id' => $des->getId(),
                'cod' => $des->getCodigo(),
                'nombre' => $des->getNombre(),
                'fechaini' => $des->getFechaIni(),
                'fechafin' => $des->getFechaFin()
            ];
        }

        return $this->json($data, 200);
    }
}
