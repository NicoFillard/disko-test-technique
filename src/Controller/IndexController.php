<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ObjectManager $manager
     * @return Response
     */
    public function index(ObjectManager $manager)
    {
        $productCategory = $manager->getRepository(Product::class);
        $listProducts = $productCategory->findBy(array(), array('price' => 'ASC'));

        return $this->render('index/index.html.twig', [
            'listProducts' => $listProducts,
        ]);
    }
}
