<?php

namespace App\Repository;

use App\Entity\HealthPro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HealthPro|null find($id, $lockMode = null, $lockVersion = null)
 * @method HealthPro|null findOneBy(array $criteria, array $orderBy = null)
 * @method HealthPro[]    findAll()
 * @method HealthPro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HealthProRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HealthPro::class);
    }

    // /**
    //  * @return HealthPro[] Returns an array of HealthPro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HealthPro
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
