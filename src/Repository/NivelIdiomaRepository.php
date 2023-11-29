<?php

namespace App\Repository;

use App\Entity\NivelIdioma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NivelIdioma>
 *
 * @method NivelIdioma|null find($id, $lockMode = null, $lockVersion = null)
 * @method NivelIdioma|null findOneBy(array $criteria, array $orderBy = null)
 * @method NivelIdioma[]    findAll()
 * @method NivelIdioma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NivelIdiomaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NivelIdioma::class);
    }

//    /**
//     * @return NivelIdioma[] Returns an array of NivelIdioma objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NivelIdioma
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
