<?php

namespace App\Controller;

use App\Entity\MobilePhone;
use App\Form\MobilePhoneType;
use App\Repository\MobilePhoneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mobile-phone')]
class MobilePhoneController extends AbstractController
{
    #[Route('/', name: 'app_mobile_phone_index', methods: ['GET'])]
    public function index(MobilePhoneRepository $mobilePhoneRepository): Response
    {
        return $this->render('mobile_phone/index.html.twig', [
            'mobile_phones' => $mobilePhoneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mobile_phone_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mobilePhone = new MobilePhone();
        $form = $this->createForm(MobilePhoneType::class, $mobilePhone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mobilePhone);
            $entityManager->flush();

            return $this->redirectToRoute('app_mobile_phone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mobile_phone/new.html.twig', [
            'mobile_phone' => $mobilePhone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mobile_phone_show', methods: ['GET'])]
    public function show(MobilePhone $mobilePhone): Response
    {
        return $this->render('mobile_phone/show.html.twig', [
            'mobile_phone' => $mobilePhone,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mobile_phone_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MobilePhone $mobilePhone, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MobilePhoneType::class, $mobilePhone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mobile_phone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mobile_phone/edit.html.twig', [
            'mobile_phone' => $mobilePhone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mobile_phone_delete', methods: ['POST'])]
    public function delete(Request $request, MobilePhone $mobilePhone, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mobilePhone->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mobilePhone);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mobile_phone_index', [], Response::HTTP_SEE_OTHER);
    }
}
