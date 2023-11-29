<?php

namespace App\Repository;

use App\Entity\Destinatario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Destinatario>
 *
 * @method Destinatario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Destinatario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Destinatario[]    findAll()
 * @method Destinatario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DestinatarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destinatario::class);
    }

//    /**
//     * @return Destinatario[] Returns an array of Destinatario objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Destinatario
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
