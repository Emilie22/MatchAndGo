<?php

namespace App\Repository;

use App\Entity\PictureBg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PictureBg|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureBg|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureBg[]    findAll()
 * @method PictureBg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureBgRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PictureBg::class);
    }

    // /**
    //  * @return PictureBg[] Returns an array of PictureBg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PictureBg
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
