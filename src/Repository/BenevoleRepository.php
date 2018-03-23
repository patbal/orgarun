<?php

namespace App\Repository;

use App\Entity\Benevole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Benevole|null find($id, $lockMode = null, $lockVersion = null)
 * @method Benevole|null findOneBy(array $criteria, array $orderBy = null)
 * @method Benevole[]    findAll()
 * @method Benevole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BenevoleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Benevole::class);
    }

    public function listeBenevoles()
    {
        $query = $this->createQueryBuilder('b')
            ->orderBy('b.nom', 'ASC');

        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Benevole[] Returns an array of Benevole objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Benevole
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}