<?php

namespace App\Controller;

use App\Entity\Baremacion;
use App\Entity\Candidato;
use App\Entity\Convocatoria;
use App\Entity\ItemBaremable;
use App\Entity\Solicitud;
use App\Repository\BaremacionRepository;
use App\Repository\CandidatoRepository;
use App\Repository\ConvocatoriaBaremablesRepository;
use App\Repository\ConvocatoriaIdiomaRepository;
use App\Repository\ConvocatoriaRepository;
use App\Repository\ItemBaremableRepository;
use App\Repository\SolicitudRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaremacionController extends AbstractController
{
    private $security;
    private $solRep;
    private $conRep;
    private $canRep;
    private $ibRep;

    public function __construct(Security $security, SolicitudRepository $solRep, ConvocatoriaRepository $conRep, CandidatoRepository $canRep, ItemBaremableRepository $ibRep)
    {
        $this->security = $security;
        $this->solRep = $solRep;
        $this->conRep = $conRep;
        $this->canRep = $canRep;
        $this->ibRep = $ibRep;
    }

    #[Route('/baremacion', name: 'app_baremacion')]
    public function index(): Response
    {
        $currentDateTime = new DateTime();
            $convocatorias = $this->conRep->findAll();
            $convocatorias = $this->conRep->createQueryBuilder('c')
                ->Where('c.Fecha_ini_pruebas > :currentDateTime')
                ->setParameter('currentDateTime', $currentDateTime)
                ->orderBy('c.Fecha_ini_pruebas', 'ASC')
                ->getQuery()
                ->getResult();
        return $this->render('baremacion/index.html.twig', [
            'convocatorias' => $convocatorias,
        ]);
    }

    #[Route('/baremacion/convocatoria', name: 'app_baremacion_convocatoria')]
    public function baremacionById(ConvocatoriaBaremablesRepository $cbRep, ConvocatoriaIdiomaRepository $ciRep, BaremacionRepository $barRep): Response
    {
        $solicitudes = $this->solRep->findBy(['Convocatoria' => $_GET['id']]);
        $convocatoria = $this->conRep->find($_GET['id']);
        $cb = $cbRep->findBy(['Convocatoria' => $_GET['id']]);
        $ci = $ciRep->findBy(['Convocatoria' => $_GET['id']]);
        $baremaciones = $barRep->findAll();

        return $this->render('baremacion/convo.html.twig', [
            'solicitudes' => $solicitudes,
            'cb' => $cb,
            'ci' => $ci,
            'convocatoria' => $convocatoria,
            'baremaciones' => $baremaciones
        ]);
    }

    #[Route('/baremacion/api/new', name: 'app_api_newbare')]
    public function addBaremacion(Request $request, EntityManagerInterface $entityManager, CandidatoRepository $canRep): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $idCandidato = $data['idCandidato'];
        $idConvocatoria = $data['idConvocatoria'];
        $idItem = $data['idItem'];
        $nota = $data['nota'];

        $convocatoria = $this->conRep->find($idConvocatoria);
        $candidato = $this->canRep->find($idCandidato);
        $item = $this->ibRep->find($idItem);

        // Buscar si ya existe una baremación para este candidato y convocatoria
        $baremacionExistente = $entityManager->getRepository(Baremacion::class)
            ->findOneBy(['Candidato' => $candidato, 'Convocatoria' => $convocatoria, 'Item' => $item]);

        if ($baremacionExistente) {
            // Actualizar la baremación existente si es necesario
            $baremacionExistente->setItem($item);
            $baremacionExistente->setNota($nota);
        } else {
            // Si no existe, crear una nueva baremación
            $baremacion = new Baremacion();
            $baremacion->setCandidato($candidato);
            $baremacion->setConvocatoria($convocatoria);
            $baremacion->setItem($item);
            $baremacion->setNota($nota);

            $entityManager->persist($baremacion);
        }

        $entityManager->flush();

        return $this->json(['message' => 'Baremación creada o actualizada'], 201);
    }

    #[Route('/baremacion/api', name: 'app_baremacion_api_getAll', methods: ['GET'])]
    public function getAllBaremaciones(BaremacionRepository $DesRep): JsonResponse
    {
        $des = $DesRep->findAll();
        $data = [];

        foreach ($des as $des) {
            $data[] = [
                'idCan' => $des->getCandidato()->getId(),
                'idCon' => $des->getConvocatoria()->getId(),
                'idItem' => $des->getItem()->getId(),
                'nota' => $des->getNota()
            ];
        }

        return $this->json($data, 200);
    }

    #[Route('/baremacion/api/{dni}', name: 'app_baremacion_api_getByDNI', methods: ['GET'])]
    public function getBaremacionesBySearcher(BaremacionRepository $DesRep, $dni): JsonResponse
    {
        $resultados = $DesRep->findByDNI($dni);
        $data = [];

        foreach ($resultados as $resultado) {
            $data[] = [
                'idCan' => $resultado['candidato_id'],
                'idCon' => $resultado['convocatoria_id'],
                'idItem' => $resultado['item_id'],
                'nota' => $resultado['nota']
            ];
        }

        return $this->json($data, 200);
    }
}
