<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/**
 * fix: https://ourcodeworld.com/articles/read/1367/how-to-solve-doctrine-uncaught-error-in-symfony-5-argument-1-passed
 * -to-apprepositoryrepository-construct-must-be-an-instance-of-doctrinecommonpersistencemanagerregistry-
 * instance-of-doctrinebundledoctrinebundleregistry-given
 */
    


// Fonction surchargées de ServiceEntityRepository:
/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    
    /**
	 * @param \DateTime $datetime
	 * @return User[]
	 */
    public function findByBirthdayMoreThan(\DateTime $datetime) {
    	return $this->createQueryBuilder('u')
			->where('u.birthday > :datetime')
			->setParameter('datetime', $datetime)
			->getQuery()
			->getResult()
		;
	}
}