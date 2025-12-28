<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aliment", name="aliment_")
 */
class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(AlimentRepository $alimentRepository, CategoryRepository $categoryRepository): Response
    {
        $aliments = $alimentRepository->findBy([], ['name' => 'ASC']);
        $alimentCategories = $categoryRepository->findAll();
        return $this->render('aliment/index.html.twig', [
            'aliments'          => $aliments,
            'alimentCategories' => $alimentCategories,
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aliment = new Aliment();
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $prettyName = $this->buildPrettyName($aliment);
            $aliment->setPrettyName($prettyName);
            $entityManager->persist($aliment);
            $entityManager->flush();

            return $this->redirectToRoute('aliment_index');
        }

        return $this->render('aliment/new.html.twig', [
           'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Request $request, Aliment $aliment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $prettyName = $this->buildPrettyName($aliment);
            $aliment->setPrettyName($prettyName);

            $entityManager->flush();

            return $this->redirectToRoute('aliment_index');
        }

        return $this->render('aliment/edit.html.twig', [
           'aliment' => $aliment,
           'form'    => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Aliment $aliment, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($aliment);
        $entityManager->flush();
        return $this->redirectToRoute('aliment_index');
    }

    private function buildPrettyName(Aliment $aliment): string
    {
        return sprintf('%s (%s)', $aliment->getName(), $aliment->getUnit()->getName());
    }

    /**
     * @param Request $request
     * @param AlimentRepository $alimentRepository
     * @Route("/async-get-by-name", name="async_search")
     * Example : http://localhost/recipe/async-get-by-name?search=riz
     * @return JsonResponse
     */
    public function asyncGetAlimentsByName(Request $request, AlimentRepository $alimentRepository): JsonResponse
    {
        $value = $request->get('search');
        $aliments = $alimentRepository->findLikeByName($value);

        $data = array_map(static function (Aliment $aliment) {
            return [
                'id' => $aliment->getId(),
                'name' => $aliment->getPrettyName(),
            ];
        }, $aliments);

        return new JsonResponse(
            $data, Response::HTTP_OK
        );
    }
}
