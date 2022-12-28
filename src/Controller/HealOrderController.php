<?php

namespace App\Controller;

use App\Entity\HealOrder;
use App\Form\HealOrderType;
use App\Repository\HealOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/heal/order')]
class HealOrderController extends AbstractController
{
    #[Route('/', name: 'app_heal_order_index', methods: ['GET'])]
    public function index(HealOrderRepository $healOrderRepository): Response
    {
        return $this->render('heal_order/index.html.twig', [
            'heal_orders' => $healOrderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_heal_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HealOrderRepository $healOrderRepository): Response
    {
        $healOrder = new HealOrder();
        $form = $this->createForm(HealOrderType::class, $healOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $healOrderRepository->save($healOrder, true);

            return $this->redirectToRoute('app_heal_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('heal_order/new.html.twig', [
            'heal_order' => $healOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_heal_order_show', methods: ['GET'])]
    public function show(HealOrder $healOrder): Response
    {
        return $this->render('heal_order/show.html.twig', [
            'heal_order' => $healOrder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_heal_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HealOrder $healOrder, HealOrderRepository $healOrderRepository): Response
    {
        $form = $this->createForm(HealOrderType::class, $healOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $healOrderRepository->save($healOrder, true);

            return $this->redirectToRoute('app_heal_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('heal_order/edit.html.twig', [
            'heal_order' => $healOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_heal_order_delete', methods: ['POST'])]
    public function delete(Request $request, HealOrder $healOrder, HealOrderRepository $healOrderRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$healOrder->getId(), $request->request->get('_token'))) {
            $healOrderRepository->remove($healOrder, true);
        }

        return $this->redirectToRoute('app_heal_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
