<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

     /**
      * @return Product[] Returns an array of Product objects
      */
    public function searchProduct($nameProduct)
    {
        return $this->createQueryBuilder('p')
            ->where('p.name LIKE :val')
            ->setParameter('val', '%'.$nameProduct.'%')
            ->innerJoin('p.category', 'c')
            ->addSelect('c')
            ->orWhere('c.name LIKE :val')
            ->setParameter('val', '%'.$nameProduct.'%')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
