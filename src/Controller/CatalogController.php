<?php

namespace App\Controller;

use App\Enum\SortingType;
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
    #[Route('/show/catalog/', 'show_spare_part_list')]
    public function showSparePartsList(Request $request): Response {
        $tagId = $request->query->get('tagId');
        $page = $request->query->get('page');
        $perPage = $request->query->get('perPage');
        $sortingType = SortingType::tryFrom($request->query->get('sortingType'));
        $sortingType2 = $request->query->get('sortingType2');
        $pagination = $this->sparePartPaginationService->paginate($tagId, $sortingType, $sortingType2, $page, $perPage);
        return $this->render('catalog/show_catalog_tag.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
