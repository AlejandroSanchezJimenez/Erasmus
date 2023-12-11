<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Entity\Convocatoria;
use App\Entity\Solicitud;
use App\Repository\CandidatoRepository;
use App\Repository\ConvocatoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SolicitudController extends AbstractController
{
    // #[Route('/solicitud', name: 'app_solicitud')]
    // public function index(): Response
    // {
    //     return $this->render('solicitud/index.html.twig', [
    //         'controller_name' => 'SolicitudController',
    //     ]);
    // }

    #[Route('/solicitud/api/new', name: 'app_api_newsoli')]
    public function addSoli(Request $request, EntityManagerInterface $entityManager, CandidatoRepository $canRep, ConvocatoriaRepository $conRep): JsonResponse
    {

        $idCandidato = $_GET['canId'];
        $idConvocatoria = $_GET['conId'];

        // Obtener archivos
        $idiomaFile = $_FILES['idioma'];
        $notasFile = $_FILES['notas'];
        $fotoDNIBlob = file_get_contents($_FILES['fotoDNI']['tmp_name'] ?? '');

        $convocatoria = new Convocatoria();
        $convocatoria = $conRep->find($idConvocatoria);
        $candidato = new Candidato();
        $candidato = $canRep->find($idCandidato);

        $solicitud = new Solicitud();

        if (!is_dir("pdf")) {
            mkdir("pdf");
        }

        move_uploaded_file($idiomaFile['tmp_name'], $candidato->getDNI() . $convocatoria->getId() . "idioma" . ".pdf");
        move_uploaded_file($notasFile['tmp_name'], $candidato->getDNI() . $convocatoria->getId() . "nota" . ".pdf");

        $solicitud->setCandidato($candidato);
        $solicitud->setConvocatoria($convocatoria);
        $solicitud->setNombre($candidato->getNombre());
        $solicitud->setDNI($candidato->getDNI());
        $solicitud->setApellidos($candidato->getApellidos());
        $solicitud->setFechaNac($candidato->getFechaNac());
        $solicitud->setTlf($candidato->getTlf());
        $solicitud->setCorreo($candidato->getCorreo());
        $solicitud->setCurso($candidato->getCurso());
        $solicitud->setDomicilio($candidato->getDomicilio());
        if ($candidato->getTutor() != null) {
            $solicitud->setIdTutor($candidato->getTutor()->getId());
        }
        $solicitud->setUrlIdioma($candidato->getDNI() . $convocatoria->getId() . "idioma" . ".pdf");
        $solicitud->setUrlNotas($candidato->getDNI() . $convocatoria->getId() . "nota" . ".pdf");
        $solicitud->setFotoDNI($fotoDNIBlob);

        $entityManager->persist($solicitud);

        $entityManager->flush();

        return $this->json(['message' => 'Convocatoria creada'], 201);
    }
}
