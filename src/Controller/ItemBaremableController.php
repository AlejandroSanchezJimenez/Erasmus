<?php

namespace App\Controller;

use App\Entity\ItemBaremable;
use App\Repository\ItemBaremableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemBaremableController extends AbstractController
{
    // #[Route('/item/baremable', name: 'app_item_baremable')]
    // public function index(): Response
    // {
    //     return $this->render('item_baremable/index.html.twig', [
    //         'controller_name' => 'ItemBaremableController',
    //     ]);
    // }

    #[Route('/itembaremable/api', name: 'app_itembaremable_api_getAll', methods: ['GET'])]
    public function getAllItemBaremable(ItemBaremableRepository $itemRep): JsonResponse
    {
        $des = $itemRep->findAll();
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
