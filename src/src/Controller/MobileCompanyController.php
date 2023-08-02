<?php

namespace App\Controller;

use App\Entity\MobileCompany;
use App\Form\MobileCompanyType;
use App\Repository\MobileCompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/mobile-company')]
class MobileCompanyController extends AbstractController
{
    #[Route('/', name: 'app_mobile_company_index', methods: ['GET'])]
    public function index(MobileCompanyRepository $mobileCompanyRepository): Response
    {
        return $this->render('mobile_company/index.html.twig', [
            'mobile_companies' => $mobileCompanyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mobile_company_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mobileCompany = new MobileCompany();
        $form = $this->createForm(MobileCompanyType::class, $mobileCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mobileCompany);
            $entityManager->flush();

            return $this->redirectToRoute('app_mobile_company_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mobile_company/new.html.twig', [
            'mobile_company' => $mobileCompany,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mobile_company_show', methods: ['GET'])]
    public function show(MobileCompany $mobileCompany): Response
    {
        return $this->render('mobile_company/show.html.twig', [
            'mobile_company' => $mobileCompany,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mobile_company_edit', methods: ['GET', 'POST'])]
    #[IsGranted('EDIT', 'mobileCompany')]
    public function edit(Request $request, MobileCompany $mobileCompany, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MobileCompanyType::class, $mobileCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mobile_company_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mobile_company/edit.html.twig', [
            'mobile_company' => $mobileCompany,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mobile_company_delete', methods: ['POST'])]
    #[IsGranted('DELETE', 'mobileCompany')]
    public function delete(Request $request, MobileCompany $mobileCompany, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mobileCompany->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mobileCompany);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mobile_company_index', [], Response::HTTP_SEE_OTHER);
    }
}
