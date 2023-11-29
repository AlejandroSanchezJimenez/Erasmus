<?php

namespace App\Repository;

use App\Entity\ConvocatoriaIdioma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConvocatoriaIdioma>
 *
 * @method ConvocatoriaIdioma|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConvocatoriaIdioma|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConvocatoriaIdioma[]    findAll()
 * @method ConvocatoriaIdioma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConvocatoriaIdiomaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConvocatoriaIdioma::class);
    }

//    /**
//     * @return ConvocatoriaIdioma[] Returns an array of ConvocatoriaIdioma objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ConvocatoriaIdioma
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
