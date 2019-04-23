<?php

namespace App\Repository;

use App\Entity\Adopter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Adopter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adopter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adopter[]    findAll()
 * @method Adopter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdopterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Adopter::class);
    }

    // /**
    //  * @return Adopter[] Returns an array of Adopter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adopter
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
