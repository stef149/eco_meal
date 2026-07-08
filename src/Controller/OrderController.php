<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderFormType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    #[Route('/order/new', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderFormType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order->setCreateAt(new \DateTimeImmutable());
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('app_order');
        }

        return $this->render('order/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/order/{id}', name: 'app_order_view')]
    public function view(Order $order): Response
    {
        return $this->render('order/view.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/order/{id}/edit', name: 'app_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Order $order, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrderFormType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_order');
        }

        return $this->render('order/update.html.twig', [
            'form' => $form,
            'order' => $order,
        ]);
    }

    #[Route('/order/{id}/delete', name: 'app_order_delete', methods: ['GET'])]
    public function delete(Order $order, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($order);
        $entityManager->flush();

        return $this->redirectToRoute('app_order');
    }
}
