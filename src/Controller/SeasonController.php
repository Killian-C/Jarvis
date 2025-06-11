<?php

namespace App\Controller;

use App\Entity\Season;
use App\Form\SeasonType;
use App\Repository\SeasonRepository;
use App\Service\SeasonDateAdapter;
use DateMalformedStringException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/season")
 */
class SeasonController extends AbstractController
{
    /**
     * @Route("/", name="season_index")
     * @param SeasonRepository $seasonRepository
     * @return Response
     */
    public function index(SeasonRepository $seasonRepository): Response
    {
        return $this->render('season/index.html.twig', [
            'seasons' => $seasonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="season_new")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SeasonDateAdapter $seasonDateAdapter
     * @return Response
     * @throws DateMalformedStringException
     */
    public function new(Request $request, EntityManagerInterface $em, SeasonDateAdapter $seasonDateAdapter): Response
    {
        $season = new Season();
        $seasonForm = $this->createForm(SeasonType::class, $season);
        $seasonForm->handleRequest($request);
        if ($seasonForm->isSubmitted() && $seasonForm->isValid()) {
            $newSeason = $seasonDateAdapter->calibrateSeasonDates($season);
            $em ->persist($newSeason);
            $em ->flush($newSeason);
            return $this->redirectToRoute('season_index');
        }

        return $this->render('season/new.html.twig', [
            'form' => $seasonForm->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="season_edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Season $season
     * @return Response
     */
    public function edit(Request $request, EntityManagerInterface $em, Season $season): Response
    {
        $seasonType = $this->createForm(SeasonType::class, $season);
        $seasonType->handleRequest($request);
        if ($seasonType->isSubmitted() && $seasonType->isValid()) {
            $em ->flush($season);
            return $this->redirectToRoute('season_index');
        }


        return $this->render('season/edit.html.twig', [
            'season' => $season,
            'form'   => $seasonType->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="season_delete")
     * @param EntityManagerInterface $em
     * @param Season $season
     * @return Response
     */
    public function delete(EntityManagerInterface $em, Season $season): Response
    {
        $em->remove($season);
        $em->flush();
        return $this->redirectToRoute('season_index');
    }
}
