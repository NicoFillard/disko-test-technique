<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ObjectManager $manager
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(ObjectManager $manager, Request $request, PaginatorInterface $paginator)
    {
        $productRepository = $manager->getRepository(Product::class);
        $listProductsQuery = $productRepository->findBy(array(), array('price' => 'ASC'));

        // Paginate the results of the query
        $listProducts = $paginator->paginate(
        // Doctrine Query, not results
            $listProductsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
        );

        return $this->render('index/index.html.twig', [
            'listProducts' => $listProducts,
        ]);
    }

    /**
     * @Route("/search", name="search")
     * @param ObjectManager $manager
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function searchAction(ObjectManager $manager, Request $request, PaginatorInterface $paginator)
    {
        $nameProduct = $request->request->get('search');

        $productRepository = $manager->getRepository(Product::class);
        $listProductsQuery = $productRepository->searchProduct($nameProduct);

        // Paginate the results of the query
        $listProducts = $paginator->paginate(
        // Doctrine Query, not results
            $listProductsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            10
        );

        return $this->render('index/index.html.twig', [
            'listProducts' => $listProducts,
        ]);
    }
}
