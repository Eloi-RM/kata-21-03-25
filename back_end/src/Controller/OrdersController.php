<?php

namespace App\Controller;

use App\Entity\Orders;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class OrdersController extends AbstractController
{
    #[Route('/orders', name: 'app_orders')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/OrdersController.php',
        ]);
    }

    //get all orders
    #[Route('/order', methods: ['GET'])]
    public function showAllOrders(EntityManagerInterface $entityManager): JsonResponse
    {
        header("Access-Control-Allow-Origin: http://localhost:5173");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $orders = $entityManager->getRepository(Orders::class)->findAll();

        $ordersData = [];
        foreach ($orders as $order) {
            $ordersData[] = [
                'id' => $order->getId(),
                'dish_id' => $order->getDishId(),
                'user_id' => $order->getUserId(),
                'status' => $order->getStatus(),
            ];
        }

        return $this->json($ordersData);
    }

    //get one order
    #[Route('/order/{id}', methods: ['GET'])]
    public function showOrder(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        header("Access-Control-Allow-Origin: http://localhost:5173");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        $order = $entityManager->getRepository(Orders::class)->find($id);

        if (!$order) {
            throw $this->createNotFoundException('No order found for id ' . $id);
        }

        return $this->json([
            'id' => $order->getId(),
            'dish_id' => $order->getDishId(),
            'user_id' => $order->getUserId(),
            'status' => $order->getStatus(),
        ]);
    }
}
