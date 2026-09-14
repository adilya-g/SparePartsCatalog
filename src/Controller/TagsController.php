<?php

namespace App\Controller;

use App\Service\Interface\ITagService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TagsController extends AbstractController
{
    function __construct(private readonly ITagService $tagService)
    {

    }
    #[Route('/show/tags', name: 'show_tags_list')]
    public function showTagsList(Request $request): Response {
        $combineId = $request->query->get('combine_id');
        $tags = $this->tagService->getAll();
        return $this->render('tags/list.html.twig', [
            'tags' => $tags,
            'combineId' => $combineId,
        ]);
    }
}
