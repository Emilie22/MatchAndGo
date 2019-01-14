<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function myFindAll() {
        $connexion = $this->getEntityManager()->getConnection();
        // on stocke la requête dans une variable
        $sql = 'SELECT au2.user_id   
                FROM user u 
                LEFT JOIN answer_user au  
                ON au.user_id = u.id 
                LEFT JOIN answer_user au2 
                ON au2.answer_id = au.answer_id 
                WHERE u.id = 3 
                AND au2.user_id <> u.id';
                
        $select = $connexion->prepare($sql);
        $select->execute();
        // je renvoie un tableau de tableaux d'articles
        return $select->fetchAll();
    }

    public function myFindAll4() {
        $queryBuilder = $this->createQueryBuilder('u')
            ->leftJoin('u.answers', 'a')
            ->addSelect('a')
            ->andWhere('u.answers.id = :test')
            ->setParameter('test', 12)
            ->getQuery();
        return $queryBuilder->execute(); 
    }

    // SELECT * FROM user u LEFT JOIN answer_user a ON a.user_id = u.id LEFT JOIN answer_user au ON au.answer_id = 2 

    // ->andWhere('a.date_publi > :datePost')
    //         ->setParameter('datePost', $datePost)


    // SELECT * FROM user LEFT JOIN answer_user au ON au.user_id = user.id LEFT JOIN answer_user a ON a.answer_id = user.answers

    // SELECT au2.user_id FROM user u LEFT JOIN answer_user au ON au.user_id = u.id LEFT JOIN answer_user au2 ON au2.answer_id = au.answer_id WHERE u.id = :id AND au2.user_id <> u.id


    // GROUP BY user_id';
}
