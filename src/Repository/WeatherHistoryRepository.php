<?php

namespace App\Repository;

use App\Entity\WeatherHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WeatherHistory>
 *
 * @method WeatherHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherHistory[]    findAll()
 * @method WeatherHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherHistory::class);
    }

    public function save(WeatherHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(WeatherHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('w')->orderBy("w.createdAt" ,"DESC");
    }

    public function getMostQueriedCity() : String
    {
        $result = $this->createQueryBuilder('w')
            ->select('w.city' )
            ->groupBy('w.city')
            ->orderBy('COUNT(w.city)' , 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        return $result[0]['city'];
    }

}
