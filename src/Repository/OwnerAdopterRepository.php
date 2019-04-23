<?php

namespace App\Repository;

use App\Entity\OwnerAdopter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OwnerAdopter|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnerAdopter|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnerAdopter[]    findAll()
 * @method OwnerAdopter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerAdopterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OwnerAdopter::class);
    }

    // /**
    //  * @return OwnerAdopter[] Returns an array of OwnerAdopter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OwnerAdopter
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
