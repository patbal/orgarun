<?php

namespace App\Repository;

use App\Entity\Postes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Postes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Postes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Postes[]    findAll()
 * @method Postes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Postes::class);
    }

    /**
     * @return mixed
     */
    public function listePostes()
    {
        return $this -> createQueryBuilder('p')
            -> OrderBy('p.nom', 'ASC')
            -> getQuery()
            -> getResult();
    }


//    /**
//     * @return Postes[] Returns an array of Postes objects
//     */
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
    public function findOneBySomeField($value): ?Postes
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
