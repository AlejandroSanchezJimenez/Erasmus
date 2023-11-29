<?php

namespace App\Repository;

use App\Entity\ConvocatoriaBaremables;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConvocatoriaBaremables>
 *
 * @method ConvocatoriaBaremables|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConvocatoriaBaremables|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConvocatoriaBaremables[]    findAll()
 * @method ConvocatoriaBaremables[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConvocatoriaBaremablesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConvocatoriaBaremables::class);
    }

//    /**
//     * @return ConvocatoriaBaremables[] Returns an array of ConvocatoriaBaremables objects
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

//    public function findOneBySomeField($value): ?ConvocatoriaBaremables
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
