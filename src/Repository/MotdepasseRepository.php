<?php

namespace App\Repository;

use App\Entity\Motdepasse;
use App\Entity\Confidentialite;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ConfidentialiteRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Motdepasse>
 *
 * @method Motdepasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Motdepasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Motdepasse[]    findAll()
 * @method Motdepasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotdepasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry , private EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Motdepasse::class);
        $this->entityManager = $entityManager;
    }

    public function save(Motdepasse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Motdepasse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByUsersPass($user, $access=null):array
    {
        if($access === null){
            $access = $this->entityManager->getRepository(Confidentialite::class)->findOneBy(['acces' => 'public']);
        }
        $qb = $this->createQueryBuilder('m');

        $qb->where('m.user = :user')
            ->orWhere(':acces MEMBER OF m.access')
            ->setParameters([
                'user' => $user,
                'acces' => $access,
            ]);

        return $qb->getQuery()->getResult();
    }

    public function PaginationQuery()
    {
        return $this->createQueryBuilder('m')
        ->orderBy('m.id', "DESC")
        ->getQuery();
    }
    public function search($searchForm) 
    {
        $input = $searchForm['texte'];
        return $this->createQueryBuilder('m')
        ->andWhere('m.username like :input')
        ->orWhere('m.website like :input')
        ->orderBy('m.id')
        ->setParameter('input','%'.$input.'%')
        ->getQuery()
        ->getResult();
    }

//    /**
//     * @return Motdepasse[] Returns an array of Motdepasse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Motdepasse
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
