<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Entity\Convocatoria;
use App\Entity\Solicitud;
use App\Repository\CandidatoRepository;
use App\Repository\ConvocatoriaRepository;
use App\Repository\SolicitudRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SolicitudController extends AbstractController
{
    private $security;
    private $user;
    private $solRep;

    public function __construct(Security $security, CandidatoRepository $user, SolicitudRepository $solRep)
    {
        $this->security = $security;
        $this->user = $user;
        $this->solRep = $solRep;
    }

    #[Route('/misSolicitudes', name: 'app_solicitud')]
    public function index(): Response
    {
        $dni = $this->security->getUser()->getUserIdentifier();
        $candidato = $this->user->findOneBy(['DNI' => $dni]);
        return $this->render('solicitud/index.html.twig', [
            'controller_name' => 'SolicitudController',
            'candidato' => $candidato
        ]);
    }

    #[Route('/misSolicitudes/expand', name: 'app_solicitud_expand')]
    public function expand(ConvocatoriaRepository $conRep): Response
    {
        $id = $_GET['id'];
        $solicitud = $this->solRep->find($id);
        return $this->render('solicitud/expand.html.twig', [
            'solicitud' => $solicitud
        ]);
    }

    #[Route('/solicitud/api/new', name: 'app_api_newsoli')]
    public function addSoli(Request $request, EntityManagerInterface $entityManager, CandidatoRepository $canRep, ConvocatoriaRepository $conRep): JsonResponse
    {

        $idCandidato = $_GET['canId'];
        $idConvocatoria = $_GET['conId'];

        // Obtener archivos
        $idiomaFile = $_FILES['idioma'] ?? null;
        $notasFile = $_FILES['notas'] ?? null;
        $fotoDNIBlob = file_get_contents($_FILES['fotoDNI']['tmp_name'] ?? '');

        $convocatoria = new Convocatoria();
        $convocatoria = $conRep->find($idConvocatoria);
        $candidato = new Candidato();
        $candidato = $canRep->find($idCandidato);

        $solicitud = new Solicitud();

        if (!is_dir("pdf")) {
            mkdir("pdf");
        }

        if ($idiomaFile && $idiomaFile['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file($idiomaFile['tmp_name'], 'pdf/'.$candidato->getDNI() . $convocatoria->getId() . "idioma" . ".pdf");
            $solicitud->setUrlIdioma($candidato->getDNI() . $convocatoria->getId() . "idioma" . ".pdf");
        }
    
        // Check and move the notas file if provided
        if ($notasFile && $notasFile['error'] === UPLOAD_ERR_OK) {
            move_uploaded_file($notasFile['tmp_name'], 'pdf/'.$candidato->getDNI() . $convocatoria->getId() . "nota" . ".pdf");
            $solicitud->setUrlNotas($candidato->getDNI() . $convocatoria->getId() . "nota" . ".pdf");
        }

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
