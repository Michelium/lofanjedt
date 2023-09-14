<?php

namespace App\Repository;

use App\Entity\Entry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

/**
 * @method Entry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entry[]    findAll()
 * @method Entry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntryRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Entry::class);
    }

    public function getEntriesByCategories(string $category, string $keyword = null) {
        $qb = $this->createQueryBuilder('e');
        $qb->andWhere('e.view_status = 5');
        $qb->andWhere('e.category IN (:val)');
        
        if ($keyword !== null) {
            $qb->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('e.base_form', ':keyword'),
                    $qb->expr()->like('e.infinitive', ':keyword'),
                    $qb->expr()->like('e.equivalent_english', ':keyword'),
                    $qb->expr()->like('e.equivalent_other_languages', ':keyword'),
                )
            );
            
            $qb->setParameter('keyword', "%{$keyword}%");
        }
        
        $qb->setParameter('val', $category);
        $qb->addOrderBy('e.base_form', 'ASC');
        $qb->addOrderBy('e.infinitive', 'ASC');

        return $qb->getQuery()->getResult();
    }

    public function getTotalEntries(): ?int {
        $qb = $this->createQueryBuilder('e');
        $qb->select('COUNT(e.id)');
        $qb->andWhere('e.view_status = 5');
        $qb->andWhere($qb->expr()->notIn('e.category', ['Daitic (obsolete)', 'Codian (obsolete)']));

        return $qb->getQuery()->getSingleScalarResult();
    }
}
