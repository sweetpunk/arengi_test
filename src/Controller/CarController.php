<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarFilterType;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/cars')]
class CarController extends AbstractController
{
    #[Route('/list', name: 'car_list')]
    public function list(CarRepository $carRepository, Request $request): Response
    {
        $filtersForm = $this->createForm(CarFilterType::class);
        $filtersForm->handleRequest($request);
        $filters = null;

        if ($filtersForm->isSubmitted() && $filtersForm->isValid()) {
            $filters = $filtersForm->getData();
        }

        $page = $request->query->getInt('page', 1);
        $cars = $carRepository->findPaginator($page, Car::MAX_BY_PAGE, $filters);

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'filtersForm' => $filtersForm,
        ]);
    }

    #[Route('/create', name: 'car_create')]
    #[IsGranted('ROLE_ADMIN')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $newCar = new Car();

        $carForm = $this->createForm(CarType::class, $newCar);
        $carForm->handleRequest($request);
        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $newCar = $carForm->getData();
            $entityManager->persist($newCar);
            $entityManager->flush();

            return $this->redirectToRoute('car_list');
        }

        return $this->render(
            'car/create.html.twig', [
                'form' => $carForm,
            ]);
    }

    #[Route('/edit/{id}', name: 'car_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Car $car, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('car_list');
        }
        return $this->render('car/edit.html.twig', ['form' => $form]);
    }

    #[Route('/delete/{id}', name: 'car_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Car $car, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($car);
        $entityManager->flush();

        return $this->redirectToRoute('car_list');
    }
}
