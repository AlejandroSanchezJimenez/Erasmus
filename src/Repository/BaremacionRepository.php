<?php

namespace App\Repository;

use App\Entity\Baremacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Baremacion>
 *
 * @method Baremacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Baremacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Baremacion[]    findAll()
 * @method Baremacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaremacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Baremacion::class);
    }

//    /**
//     * @return Baremacion[] Returns an array of Baremacion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Baremacion
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
