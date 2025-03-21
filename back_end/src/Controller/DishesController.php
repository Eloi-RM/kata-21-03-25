<?php

namespace App\Controller;

use App\Entity\Dishes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class DishesController extends AbstractController
{
    #[Route('/dishes', name: 'app_dishes')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DishesController.php',
        ]);
    }

    //get all dishes
    #[Route('/menu', methods: ['GET'])]
    public function menu(EntityManagerInterface $entityManager): JsonResponse
    {
        header("Access-Control-Allow-Origin: http://localhost:5173");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        // Récupérer les annonces depuis la base de données
        $dishes = $entityManager->getRepository(Dishes::class)->findAll();

        // Préparer les données pour la réponse JSON
        $dishesData = [];
        foreach ($dishes as $dish) {
            $dishesData[] = [
                'id' => $dish->getId(),
                'name' => $dish->getName(),
                'description' => $dish->getDescription(),
                'logo' => $dish->getLogo(),
                // Ajoutez d'autres champs selon vos besoins
            ];
        }

        // Retourner les données sous forme de JSON
        return $this->json($dishesData);
    }
}
