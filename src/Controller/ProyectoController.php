<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
