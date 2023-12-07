<?php

namespace App\Repository;

use App\Entity\ConvocatoriaDestinatario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConvocatoriaDestinatario>
 *
 * @method ConvocatoriaDestinatario|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConvocatoriaDestinatario|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConvocatoriaDestinatario[]    findAll()
 * @method ConvocatoriaDestinatario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConvocatoriaDestinatarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConvocatoriaDestinatario::class);
    }

//    /**
//     * @return ConvocatoriaDestinatario[] Returns an array of ConvocatoriaDestinatario objects
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

//    public function findOneBySomeField($value): ?ConvocatoriaDestinatario
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
