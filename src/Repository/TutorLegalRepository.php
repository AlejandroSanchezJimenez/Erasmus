<?php

namespace App\Repository;

use App\Entity\TutorLegal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TutorLegal>
 *
 * @method TutorLegal|null find($id, $lockMode = null, $lockVersion = null)
 * @method TutorLegal|null findOneBy(array $criteria, array $orderBy = null)
 * @method TutorLegal[]    findAll()
 * @method TutorLegal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutorLegalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TutorLegal::class);
    }

//    /**
//     * @return TutorLegal[] Returns an array of TutorLegal objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TutorLegal
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
