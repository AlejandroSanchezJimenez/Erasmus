<?php

namespace App\Controller;

use App\Entity\Baremacion;
use App\Entity\Candidato;
use App\Entity\Convocatoria;
use App\Entity\ConvocatoriaBaremables;
use App\Entity\ConvocatoriaDestinatario;
use App\Entity\ConvocatoriaIdioma;
use App\Entity\Destinatario;
use App\Entity\NivelIdioma;
use App\Entity\Proyecto;
use App\Repository\CandidatoRepository;
use App\Repository\ConvocatoriaBaremablesRepository;
use App\Repository\ConvocatoriaDestinatarioRepository;
use App\Repository\ConvocatoriaIdiomaRepository;
use App\Repository\ConvocatoriaRepository;
use App\Repository\DestinatarioRepository;
use App\Repository\ItemBaremableRepository;
use App\Repository\NivelIdiomaRepository;
use App\Repository\ProyectoRepository;
use DateTime;
use Doctrine\DBAL\Portability\Converter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class ConvocatoriasController extends AbstractController
{
    private $security;
    private $user;
    private $conRep;
    private $cobRep;
    private $candi;
    private $cdRep;

    public function __construct(Security $security, CandidatoRepository $user, ConvocatoriaRepository $conRep, ConvocatoriaBaremablesRepository $cobRep, ConvocatoriaDestinatarioRepository $cdRep, CandidatoRepository $candi)
    {
        $this->security = $security;
        $this->user = $user;
        $this->conRep = $conRep;
        $this->cobRep = $cobRep;
        $this->candi = $candi;
        $this->cdRep = $cdRep;
    }

    #[Route('/convocatorias/form', name: 'app_formconvo')]
    public function expanded(): Response
    {
        $dni = $this->security->getUser()->getUserIdentifier();
        $candidato = $this->user->findOneBy(['DNI' => $dni]);
        $id = $_GET['conId'];
        $convocatoria = $this->conRep->find($id);
        $convocatoriaBaremables = $this->cobRep->findBy(['Convocatoria' => $id]);

        return $this->render('convocatorias/form.html.twig', [
            'candidato' => $candidato,
            'convocatoria' => $convocatoria,
            'baremos' => $convocatoriaBaremables
        ]);
    }

    #[Route('/convocatorias', name: 'app_convocatorias')]
    public function index(): Response
    {
        if (isset($_GET['proId'])) {
            $currentDateTime = new DateTime();
            $convocatorias = $this->conRep->findAll();
            $convocatorias = $this->conRep->createQueryBuilder('c')
                ->Where('c.Fecha_ini_pruebas > :currentDateTime')
                ->andWhere('c.Proyecto = :idpro')
                ->setParameter('currentDateTime', $currentDateTime)
                ->setParameter('idpro', $_GET['proId'])
                ->orderBy('c.Fecha_ini_pruebas', 'ASC')
                ->getQuery()
                ->getResult();
            // $convocatorias = $this->conRep->findBy(['Proyecto' => $_GET['proId']]);
        } else {
            $currentDateTime = new DateTime();
            $convocatorias = $this->conRep->findAll();
            $convocatorias = $this->conRep->createQueryBuilder('c')
                ->Where('c.Fecha_ini_pruebas > :currentDateTime')
                ->setParameter('currentDateTime', $currentDateTime)
                ->orderBy('c.Fecha_ini_pruebas', 'ASC')
                ->getQuery()
                ->getResult();
        }

        // $id = $_GET['conId'];
        // $destinatarios = $this->cdRep->findBy(['Convocatoria' => $id]);

        return $this->render('convocatorias/index.html.twig', [
            'convocatorias' => $convocatorias,
            // 'destinatarios' => $destinatarios
        ]);
    }

    #[Route('/convocatorias/new', name: 'app_newconvo')]
    public function newForm(): Response
    {
        return $this->render('convocatorias/new.html.twig', [
            'controller_name' => 'ConvocatoriasController',
        ]);
    }

    #[Route('/convocatorias/api/new', name: 'app_api_newconvo')]
    public function addConvo(Request $request, EntityManagerInterface $entityManager, ProyectoRepository $proRep, DestinatarioRepository $desRep, ItemBaremableRepository $itebRep, NivelIdiomaRepository $nividiRep): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $idproyecto = $data['idProyecto'];
        $nombre = $data['nombre'];
        $tipo = $data['tipo'];
        $movilidades = $data['movilidades'];
        $fechaini = new DateTime($data['fechaInicio']);
        $fechafin = new DateTime($data['fechaFin']);
        $fechainiprue = new DateTime($data['fechaPruebasInicio']);
        $fechafinprue = new DateTime($data['fechaPruebasFin']);
        $fechalisprov = new DateTime($data['fechaListadoProvisional']);
        $fechalisofi = new DateTime($data['fechaListadoOficial']);

        $convocatoria = new Convocatoria();
        $proyecto = new Proyecto();
        $proyecto = $proRep->find($idproyecto);

        $convocatoria->setProyecto($proyecto);
        $convocatoria->setNombre($nombre);
        $convocatoria->setTipo($tipo);
        $convocatoria->setMovilidades($movilidades);
        $convocatoria->setFechaIni($fechaini);
        $convocatoria->setFechaFin($fechafin);
        $convocatoria->setFechaIniPruebas($fechainiprue);
        $convocatoria->setFechaFinPruebas($fechafinprue);
        $convocatoria->setFechaListaProv($fechalisprov);
        $convocatoria->setFechaListaFinal($fechalisofi);

        $entityManager->persist($convocatoria);
        $entityManager->flush();

        foreach ($data['destinatarios'] as $idDestinatario) {
            $destinatario = $desRep->find($idDestinatario);

            if ($destinatario) {
                $condes = new ConvocatoriaDestinatario();
                $condes->setConvocatoria($convocatoria);
                $condes->setDestinatario($destinatario);

                $entityManager->persist($condes);
            }
        }

        $entityManager->flush();

        foreach ($data['baremos'] as $baremo) {
            // Obtener el objeto Baremo
            $idBaremo = $itebRep->find($baremo['idBaremo']);

            if ($idBaremo) {  // Verificar si se encontró el baremo
                $conbar = new ConvocatoriaBaremables();
                $conbar->setConvocatoria($convocatoria);
                $conbar->setItem($idBaremo);
                $conbar->setMaximo($baremo['Maximo']);
                $conbar->setRequisito($baremo['Requisito'] === "true" ? true : false);
                $conbar->setMinimo($baremo['Minimo']);
                $conbar->setAportaCandidato($baremo['Aporta'] === "true" ? true : false);

                $entityManager->persist($conbar);
            }
        }

        $entityManager->flush();

        if ($data['idiomas'] !== null) {
            foreach ($data['idiomas'] as $idioma) {
                // Obtener el objeto Baremo
                $conidi = new ConvocatoriaIdioma();
                $conidi->setConvocatoria($convocatoria);
                $conidi->setNivelIdioma($nividiRep->find($idioma['id']));
                $conidi->setPuntuacion($idioma['valor']);

                $entityManager->persist($conidi);
            }

            $entityManager->flush();
        }

        return $this->json(['message' => 'Convocatoria creada'], 201);
    }
}
