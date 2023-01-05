<?php

namespace App\Controller;

use App\Entity\Broker;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BrokerController extends AbstractController
{
    #[Route('/brokers', name: 'broker_index', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $brokers = $doctrine->getRepository(Broker::class)->findAll();
        $data = [];

        foreach ($brokers as $broker) {
            $data[] = [
                'name' => $broker->getName(),
                'address' => $broker->getAddress(),
                'premium' => $broker->getPremium()
            ];
        }

        return $this->json($data);
    }


    #[Route('/brokers/{id}', name: 'broker_show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $broker = $doctrine->getRepository(Broker::class)->find($id);

        if (!$broker) {
            throw $this->createNotFoundException('No broker found for id ' . $id);
        }

        $data = [
            'name' => $broker->getName(),
            'address' => $broker->getAddress(),
            'premium' => $broker->getPremium()
        ];

        return $this->json($data);
    }


    #[Route('/brokers', name: 'broker_create', methods: ['POST'])]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        $broker = new Broker();
        $broker->setName($request->request->get('name'));
        $broker->setAddress($request->request->get('address'));
        $broker->setPremium($request->request->get('premium'));

        $entityManager->persist($broker);
        $entityManager->flush();
        
        return $this->json('New broker added with ID ' . $broker->getId());
    }
}
