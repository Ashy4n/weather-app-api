<?php

namespace App\Repository;

use App\Entity\Weather;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Weather>
 *
 * @method Weather|null find($id, $lockMode = null, $lockVersion = null)
 * @method Weather|null findOneBy(array $criteria, array $orderBy = null)
 * @method Weather[]    findAll()
 * @method Weather[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Weather::class);
    }

    public function save(Weather $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Weather $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getNumberOfQueries(): int
    {
        $result = $this->createQueryBuilder('w')
            ->select('COUNT(w) as allQ')
            ->getQuery()
            ->getOneOrNullResult();

        return $result['allQ'];
    }

    public function getTemperatureData(): array
    {
        $result = $this->createQueryBuilder('w')
            ->select(
                'AVG(w.temperatureValue) as AVG',
                'MIN(w.temperatureValue) as MIN',
                'MAX(w.temperatureValue) as MAX'
            )
            ->getQuery()
            ->getOneOrNullResult();

        return $result;
    }

}
