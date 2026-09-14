<?php

namespace App\Controller;

use App\DTO\SearchOptions;
use App\Enum\SortingType;
use App\Form\SearchOptionsType;
use App\Service\Interface\ICombineService;
use App\Service\Interface\ISparePartPaginationService;
use App\Service\Interface\ITagService;
use App\Service\Interface\ITypeService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogController extends AbstractController
{
    function __construct(
        private readonly ISparePartPaginationService $sparePartPaginationService,
        private readonly ICombineService $combineService,
        private readonly ITagService $tagService,
        private readonly ITypeService $typeService,
        private readonly LoggerInterface $logger,
    )
    {

    }
    #[Route('/show/catalog', name: 'show_spare_part_list')]
    public function showSparePartsList(Request $request): Response {
        $searchOptions = new SearchOptions();
        $form = $this->createForm(SearchOptionsType::class, $searchOptions);
        $form->handleRequest($request);
        $page = $request->query->get('page');

        $searchOptions = $form->getData();
        $searchOptions->page = $page;
        $typeId = $request->query->get('typeId');
        $searchOptions->typeId = !empty($typeId) ? (int) $typeId : null;

        $combineId = $request->query->get('combineId');
        $searchOptions->combineId = !empty($combineId) ? (int) $combineId : null;$this->logger->info('TypeId: ' . $searchOptions->typeId);
        $this->logger->info('CombineId: ' . $searchOptions->combineId);

        $tagList = $this->tagService->getAll();
        $typeList = $this->typeService->getAll();
        $combineList = $this->combineService->getAll();

        $pagination = $this->sparePartPaginationService->paginate($form->getData());

        return $this->render('catalog/show_catalog_tag.html.twig', [
            'pagination' => $pagination,
            'form' => $form->createView(),
            'combineList' => $combineList,
            'tagList' => $tagList,
            'typeList' => $typeList,
        ]);
    }

    #[Route('/show/combines', name: 'show_combines_list')]
    public function showCombinesList(Request $request): Response {
        $combinesList = $this->combineService->getAll();
        return $this->render('catalog/show_combines.html.twig', [
            'combinesList' => $combinesList,
        ]);
    }

    #[Route('/show/types', name: 'show_types_list')]
    public function showTypeList(Request $request): Response {
        $combineId = $request->query->get('combineId');
        $typeList = $this->typeService->getAll();
        return $this->render('catalog/show_types.html.twig', [
            'typesList' => $typeList,
            'combineId' => $combineId,
        ]);
    }
}
