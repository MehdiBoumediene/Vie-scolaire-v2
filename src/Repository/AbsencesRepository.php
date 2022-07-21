<?php

namespace App\Repository;

use App\Entity\Absences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Absences|null find($id, $lockMode = null, $lockVersion = null)
 * @method Absences|null findOneBy(array $criteria, array $orderBy = null)
 * @method Absences[]    findAll()
 * @method Absences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbsencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Absences::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Absences $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Absences $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findByUser($user,$delay,$day)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.user = :val')
       
            ->andWhere('a.absent = :absent')
            ->setParameter('val', $user)

            ->setParameter('absent', 1)
            ->orderBy('a.date', 'DESC')
         
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByUserAbsences($user,$delay,$day)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.user = :val')

            ->andWhere('a.enretard = :retard')
            ->setParameter('val', $user)
            ->setParameter('retard', 1)
            ->orderBy('a.date', 'DESC')
        
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Absences
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
