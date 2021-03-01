<?php

namespace App\Repository;

use App\Entity\Accommodation;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Accommodation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accommodation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accommodation[]    findAll()
 * @method Accommodation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccommodationRepository extends ServiceEntityRepository
{
   public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Accommodation::class);
   }
	 
	public function findRoomAccommodation(DateTime $from, DateTime $to)
	{
		$sql = "
			SELECT 
				a, r, g
			FROM 
				App\Entity\Accommodation a
			JOIN
				a.rooms r
			JOIN
				a.guests g
			WHERE
					a.checkInAt > :from AND a.checkInAt < :to
				OR 
					a.checkOutAt > :from AND a.checkOutAt < :to";
		
		$query = $this->getEntityManager()->createQuery($sql);
		$query->setParameter("from", $from);
		$query->setParameter("to", $to);
		return $query->getResult();
	}

	public function findRequiredActions()
	{
		$sql = "
			SELECT 
				COUNT(a.id)
			FROM
				App\Entity\Accommodation a
			WHERE
				a.status = 0";
		
		$query = $this->getEntityManager()->createQuery($sql);
		return $query->getSingleScalarResult();
	}

    // /**
    //  * @return Accommodation[] Returns an array of Accommodation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Accommodation
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
