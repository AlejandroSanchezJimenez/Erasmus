<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Repository\CandidatoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidatoController extends AbstractController
{
    // #[Route('/candidato', name: 'app_candidato')]
    // public function index(): Response
    // {
    //     return $this->render('candidato/index.html.twig', [
    //         'controller_name' => 'CandidatoController',
    //     ]);
    // }

    // #[Route('/Candidato/api/crear', name: 'app_Candidato_api_add', methods: ['POST'])]
    // public function addCandidato(Request $request, CandidatoRepository $CandidatoRepository): JsonResponse
    // {
    //     $data = json_decode($request->getContent(), true);

    //     // Obtener los datos del Candidato (id, email, isVerified) desde $data
    //     $id = $data['id'];
    //     $email = $data['email'];
    //     $isVerified = $data['isVerified'];

    //     // Crear una nueva entidad de Candidato
    //     $Candidato = new Candidato();
    //     $Candidato->setEmail($id);
    //     $Candidato->setEmail($email);
    //     $Candidato->setIsVerified($isVerified);

    //     // Guardar el Candidato en la base de datos
    //     $CandidatoRepository->save($Candidato, true);

    //     return $this->json(['message' => 'Candidato creado'], 201);
    // }

    #[Route('/candidato/api/eliminar/{id}', name: 'app_Candidato_api_delete', methods: ['DELETE'])]
    public function removeCandidato(CandidatoRepository $CandidatoRepository, $id): JsonResponse
    {
        $Candidato = $CandidatoRepository->find($id);

        if (!$Candidato) {
            return $this->json(['message' => 'No existe un Candidato con ese ID'], 404);
        }

        $CandidatoRepository->remove($Candidato, true);

        return $this->json(['message' => 'Candidato eliminado'], 204);
    }

    #[Route('/candidato/api/{id}', name: 'app_Candidato_api_getOne', methods: ['GET'])]
    public function getCandidato(CandidatoRepository $CandidatoRepository, $id): JsonResponse
    {
        $Candidato = $CandidatoRepository->find($id);

        if (!$Candidato) {
            return $this->json(['message' => 'No existe un Candidato con ese ID'], 404);
        }

        $data = [
            'id' => $Candidato->getId(),
            'DNI' => $Candidato->getDNI(),
            'Nombre' => $Candidato->getNombre(),
            'Apellidos' => $Candidato->getApellidos(),
            'Curso' => $Candidato->getCurso(),
            'Tlf' => $Candidato->getTlf(),
            'Fecha_nac' => $Candidato->getFechaNac(),
            'Correo' => $Candidato->getCorreo(),
            'Domicilio' => $Candidato->getDomicilio(),
            'Tutor' => $Candidato->getTutor()
        ];

        return $this->json($data, 200);
    }

    #[Route('/candidato/api', name: 'app_Candidato_api_getAll', methods: ['GET'])]
    public function getAllCandidatos(CandidatoRepository $CandidatoRepository): JsonResponse
    {
        $Candidatos = $CandidatoRepository->findUsers();
        $data = [];

        foreach ($Candidatos as $Candidato) {
            $data[] = [
                'id' => $Candidato->getId(),
                'DNI' => $Candidato->getDNI(),
                'Nombre' => $Candidato->getNombre(),
                'Apellidos' => $Candidato->getApellidos(),
                'Curso' => $Candidato->getCurso(),
                'Tlf' => $Candidato->getTlf(),
                'Fecha_nac' => $Candidato->getFechaNac(),
                'Correo' => $Candidato->getCorreo(),
                'Domicilio' => $Candidato->getDomicilio(),
                'Tutor' => $Candidato->getTutor()
            ];
        }

        return $this->json($data, 200);
    }

    #[Route('/candidato/api/editar/{id}', name: 'app_Candidato_api_updateOne', methods: ['PUT'])]
    public function updateCandidatoByID(Request $request, $id, CandidatoRepository $CandidatoRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $Candidato = $CandidatoRepository->find($id);
        $data = json_decode($request->getContent(), true);

        // Actualiza los campos del Candidato
        $Candidato->setRoles($data['rol']);

        $entityManager->persist($Candidato);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Candidato actualizado con éxito']);
    }
}
