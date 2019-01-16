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

    public function myFindAll($id) {
        $connexion = $this->getEntityManager()->getConnection();
        $sql = 'SELECT au2.user_id    
                FROM user u 
                LEFT JOIN answer_user au  
                ON au.user_id = u.id 
                LEFT JOIN answer_user au2 
                ON au2.answer_id = au.answer_id 
                WHERE u.id = :id 
                AND au2.user_id <> u.id';
                
        $select = $connexion->prepare($sql);
        $select->bindValue(':id', $id);
        $select->execute();
        return $select->fetchAll();
    }




}
