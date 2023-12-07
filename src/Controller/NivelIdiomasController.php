<?php

namespace App\Controller;

use App\Entity\NivelIdioma;
use App\Repository\NivelIdiomaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NivelIdiomasController extends AbstractController
{
    // #[Route('/nivel/idiomas', name: 'app_nivel_idiomas')]
    // public function index(): Response
    // {
    //     return $this->render('nivel_idiomas/index.html.twig', [
    //         'controller_name' => 'NivelIdiomasController',
    //     ]);
    // }

    #[Route('/nivelidiomas/api', name: 'app_nivelidiomas_api_getAll', methods: ['GET'])]
    public function getAllCandidatos(NivelIdiomaRepository $DesRep): JsonResponse
    {
        $des = $DesRep->findAll();
        $data = [];

        foreach ($des as $des) {
            $data[] = [
                'id' => $des->getId(),
                'nombre' => $des->getNombre()
            ];
        }

        return $this->json($data, 200);
    }
}
