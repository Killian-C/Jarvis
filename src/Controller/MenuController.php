<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Menu;
use App\Entity\RecipeType;
use App\Entity\Season;
use App\Entity\Shift;
use App\Form\MenuDateStepType;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use App\Repository\RecipeRepository;
use App\Repository\RecipeTypeRepository;
use App\Repository\SeasonRepository;
use App\Service\SeasonDateAdapter;
use App\Service\ShiftService;
use DateMalformedStringException;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu", name="menu_")
 */
class MenuController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(MenuRepository $menuRepository): Response
    {
        $byMonthYearMenus = $menuRepository->findAllGroupedByMonthYear();
        return $this->render('menu/index.html.twig', [
            'month_year_menus' => $byMonthYearMenus,
        ]);
    }

    /**
     * @Route("/favorites", name="index_favorites")
     * @throws Exception
     */
    public function indexFavorites(MenuRepository $menuRepository, SeasonRepository $seasonRepository, SeasonDateAdapter $seasonDateAdapter): Response
    {
        $favoritesMenus         = $menuRepository->findBy(['isFavorite' => true]);
        $seasons                = $seasonRepository->findAll();
        $favoriteMenusBySeasons = [];

        foreach ($seasons as $season) {
            $season          = $seasonDateAdapter->actualizeSeasonToCurrentYear($season);
            $seasonStartDate = $season->getStartDate();
            $seasonEndDate   = $season->getEndDate();
            $currentYear     = (int)(new DateTime())->format('Y');
            foreach ($favoritesMenus as $favoriteMenu) {
                //Le seasonAdapter n'a peut-êtr epas le bon nom,
                // je l'utilise ici parce que j'ai besoin de synchroniser la date du menu et celle de la saison à l'année en cours
                $favoriteMenuStartDate = $seasonDateAdapter->adapt(New DateTime($favoriteMenu->getStartedAt()->format('Y-m-d')), $currentYear);
                if ($favoriteMenuStartDate >= $seasonStartDate && $favoriteMenuStartDate <= $seasonEndDate) {
                    $favoriteMenusBySeasons[$season->getName()][] = $favoriteMenu;
                }
            }
        }

        return $this->render('menu/index_favorites.html.twig', [
            'menu_favorites_by_seasons' => $favoriteMenusBySeasons,
        ]);
    }

    /**
     * @Route("/new", name="new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param ShiftService $shiftService
     * @param RecipeRepository $recipeRepository
     * @param SeasonRepository $seasonRepository
     * @param RecipeTypeRepository $recipeTypeRepository
     * @return Response
     * @throws DateMalformedStringException
     * @throws Exception
     */
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        ShiftService $shiftService,
        RecipeRepository $recipeRepository,
        SeasonRepository $seasonRepository,
        RecipeTypeRepository $recipeTypeRepository
    ): Response
    {
        $menu            = new Menu();
        $menuTypeOptions = [ MenuType::OPT_KEY_MODE => MenuType::OPT_ARG_MODE_NEW ];
        $formDateStep    = $this->createForm(MenuDateStepType::class, $menu);
        $formShiftStep   = $this->createForm(MenuType::class, $menu, $menuTypeOptions);

        $formDateStep->handleRequest($request);
        if ($formDateStep->isSubmitted() && $formDateStep->isValid()) {
            $start   = $menu->getStartedAt();
            $end     = $menu->getFinishedAt();
            $shifts  = $shiftService->getShiftsByMenuDates($start, $end);
            $seasons = $seasonRepository->findSeasonByDate(new DateTime($start->format('Y-m-d')));
            $seasonNames = array_map(function ($season) {
                return $season->getName();
            }, $seasons);
            $seasonsQuery = implode(", ", $seasonNames);

            foreach($shifts as $shiftData) {
                $shift = new Shift();
                $shift->setIdentifier($shiftData[Shift::KEY_SHIFT_DAY]);
                $shift->setMoment($shiftData[Shift::KEY_SHIFT_MOMENT]);
                $menu->addShift($shift);
            }
            $formShiftStep = $this->createForm(MenuType::class, $menu,$menuTypeOptions);
            $recipes       = $recipeRepository->findBy([], [ 'title' => 'ASC' ]);
            return $this->render('menu/new.html.twig', [
                'form_shift_step'             => $formShiftStep->createView(),
                'date_step'                   => false,
                'recipes'                     => $recipes,
                'seasons'                     => $seasons,
                'all_recipe_types'            => $recipeTypeRepository->findAll(),
                'default_recipe_type_filters' => RecipeType::DEFAULT_TYPE_FILTERS,
                'seasons_query'               => $seasonsQuery,
            ]);
        }

        $formShiftStep->handleRequest($request);
        if ($formShiftStep->isSubmitted() && $formShiftStep->isValid()) {
            foreach ($menu->getShifts() as $shift) {
                $shift->setMenu($menu);
                foreach ($shift->getDishes() as $dish) {
                    $dish->setShift($shift);
                }
            }
            $entityManager->persist($menu);
            $entityManager->flush();
            return $this->redirectToRoute('menu_index');
        }

        return $this->render('menu/new.html.twig', [
            'form_date_step'   => $formDateStep->createView(),
            'date_step'        => true,
            'all_recipe_types' => $recipeTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Menu $menu): Response
    {
        return $this->render('menu/show.html.twig', [
            'menu' => $menu
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"POST"})
     * @throws DateMalformedStringException
     */
    public function edit(
        Menu $menu,
        Request $request,
        EntityManagerInterface $entityManager,
        RecipeRepository $recipeRepository,
        SeasonRepository $seasonRepository,
        RecipeTypeRepository $recipeTypeRepository
    ): Response
    {
        $seasons = $seasonRepository->findSeasonByDate($menu->getStartedAt());
        $seasonNames = array_map(function ($season) {
            return $season->getName();
        }, $seasons);
        $seasonsQuery = implode(", ", $seasonNames);
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($menu->getShifts() as $shift) {
                $shift->setMenu($menu);
                foreach ($shift->getDishes() as $dish) {
                    $dish->setShift($shift);
                }
                $entityManager->persist($shift);
            }
            $entityManager->flush();
            return $this->redirectToRoute('menu_index');
        }

        $recipes = $recipeRepository->findBy([], [ 'title' => 'ASC' ]);

        return $this->render('menu/edit.html.twig', [
            'menu'                        => $menu,
            'form_shift_step'             => $form->createView(),
            'date_step'                   => false,
            'recipes'                     => $recipes,
            'seasons'                     => $seasons,
            'all_recipe_types'            => $recipeTypeRepository->findAll(),
            'default_recipe_type_filters' => RecipeType::DEFAULT_TYPE_FILTERS,
            'seasons_query'               => $seasonsQuery,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"POST"})
     */
    public function delete(Menu $menu, EntityManagerInterface $entityManager): Response
    {
        $shifts = $menu->getShifts();
        foreach ($shifts as $shift) {
            $dishes = $shift->getDishes();
            foreach ($dishes as $dish) {
                $entityManager->remove($dish);
            }
            $entityManager->remove($shift);
        }

        $shoppingList = $menu->getShoppinglist();
        if ($shoppingList) {
            $entityManager->remove($shoppingList);
        }

        $entityManager->remove($menu);
        $entityManager->flush();
        return $this->redirectToRoute('menu_index');
    }

    /**
     * @param Dish $dish
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * @Route("/async-delete-dish/{id}", name="async_delete_dish",methods={"POST"})
     */
    public function deleteDish(Dish $dish, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $entityManager->remove($dish);
            $entityManager->flush();
        } catch (Exception $e) {
            dump($e->getMessage());
            return new JsonResponse(["error" => $e], 500);
        }
        return new JsonResponse([], 200);
    }

    /**
     * @param Menu $menu
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * @Route("/async-change-is-favorite/{id}", name="async_change_is_favorite", methods={"POST"})
     */
    public function changeFavoriteState(Menu $menu, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $menu->setIsFavorite(!$menu->getIsFavorite());
            $entityManager->flush();
        } catch (Exception $e) {
            return new JsonResponse(["error" => $e], 500);
        }

        return new JsonResponse([], 200);
    }
}

