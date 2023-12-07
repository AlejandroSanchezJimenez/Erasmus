<?php

namespace App\Controller;

use App\Entity\Convocatoria;
use App\Entity\ConvocatoriaDestinatario;
use App\Entity\Destinatario;
use App\Repository\ConvocatoriaDestinatarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConvocatoriaDestinatarioController extends AbstractController
{
    // #[Route('/convocatoria/destinatario', name: 'app_convocatoria_destinatario')]
    // public function index(): Response
    // {
    //     return $this->render('convocatoria_destinatario/index.html.twig', [
    //         'controller_name' => 'ConvocatoriaDestinatarioController',
    //     ]);
    // }

    #[Route('/convocatorias/api/new', name: 'app_api_newconvo')]
    public function addConvo(Request $request, EntityManagerInterface $entityManager, ConvocatoriaDestinatarioRepository $condesRep): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $destinatarios = $data['destinatarios'];
        $nombre = $data['nombre'];

        foreach ($destinatarios as $destinatario) {
            $destinatario = new Destinatario();
            $convocatoria = new Convocatoria();

            $entityManager->persist($convocatoria);
            $entityManager->flush();
        }

        return $this->json(['message' => 'Examen creado'], 201);
    }
}
