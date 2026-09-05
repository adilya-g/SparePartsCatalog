<?php

namespace App\Controller;

use App\DTO\SearchOptions;
use App\Enum\SortingType;
use App\Form\SearchOptionsType;
use App\Service\Interface\ISparePartPaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogController extends AbstractController
{
    function __construct(private readonly ISparePartPaginationService $sparePartPaginationService)
    {

    }
    #[Route('/show/catalog', name: 'show_spare_part_list')]
    public function showSparePartsList(Request $request): Response {
        $searchOptions = new SearchOptions();
        $form = $this->createForm(SearchOptionsType::class, $searchOptions);
        $form->handleRequest($request);
        $pagination = $request->request->get('pagination') ?? null;
        if ($form->isSubmitted() && $form->isValid()) {
            $page = $request->request->get('page');
            $searchOptions = $form->getData();
            $searchOptions->page = $page;
            $pagination = $this->sparePartPaginationService->paginate($form->getData());
        }
        else {
            $searchOptions = new SearchOptions();
            $pagination = $this->sparePartPaginationService->paginate($searchOptions);
        }

        return $this->render('catalog/show_catalog_tag.html.twig', [
            'pagination' => $pagination,
            'form' => $form->createView(),
        ]);
    }
}
