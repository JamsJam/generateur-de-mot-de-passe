<?php

namespace App\Repository;

use App\Entity\Log;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends ServiceEntityRepository<Log>
 *
 * @method Log|null find($id, $lockMode = null, $lockVersion = null)
 * @method Log|null findOneBy(array $criteria, array $orderBy = null)
 * @method Log[]    findAll()
 * @method Log[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Log::class);
    }

    public function save(Log $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Log $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function PaginationQuery()
    {
        return $this->createQueryBuilder('l')
        ->orderBy('l.id', "DESC")
        ->getQuery();
    }
    /**
     * @return Log[] Returns an array of Log objects
     *
     * @param DateTimeImmutable $datelimit  date limite de recherche 
     * @param Int $limit  nombre de log a retourner

     */
    public function findLogsByDate(DateTimeImmutable $datelimit): array
    {
        $qb = $this->createQueryBuilder('l')
            ->andWhere('l.logAt >= :date')
            ->andWhere('l.logAt <= :datelimit')
            ->orderBy("l.logAt","DESC")
            ->setParameter('date', new \DateTimeImmutable());


        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Log[] Returns an array of Log objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Log
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
