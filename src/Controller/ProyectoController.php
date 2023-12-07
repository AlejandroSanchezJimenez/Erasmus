<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Repository\ProyectoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProyectoController extends AbstractController
{
    #[Route('/proyectos', name: 'app_proyecto')]
    public function index(): Response
    {
        return $this->render('proyecto/index.html.twig', [
            'controller_name' => 'ProyectoController',
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
