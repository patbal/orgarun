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

}
