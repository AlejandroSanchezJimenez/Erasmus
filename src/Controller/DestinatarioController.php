<?php

namespace App\Controller;

use App\Entity\Destinatario;
use App\Repository\DestinatarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinatarioController extends AbstractController
{
    // #[Route('/destinatario', name: 'app_destinatario')]
    // public function index(): Response
    // {
    //     return $this->render('destinatario/index.html.twig', [
    //         'controller_name' => 'DestinatarioController',
    //     ]);
    // }

    #[Route('/destinatario/api', name: 'app_destinatario_api_getAll', methods: ['GET'])]
    public function getAllCandidatos(DestinatarioRepository $DesRep): JsonResponse
    {
        $des = $DesRep->findAll();
        $data = [];

        foreach ($des as $des) {
            $data[] = [
                'cod' => $des->getCodGrupo(),
                'nombre' => $des->getNombre()
            ];
        }

        return $this->json($data, 200);
    }
}
