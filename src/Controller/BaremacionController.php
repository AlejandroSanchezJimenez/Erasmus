<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaremacionController extends AbstractController
{
    #[Route('/baremacion', name: 'app_baremacion')]
    public function index(): Response
    {
        return $this->render('baremacion/index.html.twig', [
            'controller_name' => 'BaremacionController',
        ]);
    }
}
