<?php

namespace Pidia\Apps\Demo\Repository;

use Pidia\Apps\Demo\Entity\Trabajador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Pidia\Apps\Demo\Security\Security;
use Pidia\Apps\Demo\Util\Paginator;

/**
 * @method Trabajador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trabajador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trabajador[]    findAll()
 * @method Trabajador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrabajadorRepository extends ServiceEntityRepository implements BaseRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Trabajador::class);
        $this->security = $security;
    }

    public function findLatest(array $params): Paginator
    {
        $queryBuilder = $this->filterQuery($params);

        return Paginator::create($queryBuilder, $params);
    }

    public function filter(array $params, bool $inArray = true): array
    {
        $queryBuilder = $this->filterQuery($params);

        if (true === $inArray) {
            return $queryBuilder->getQuery()->getArrayResult();
        }

        return $queryBuilder->getQuery()->getResult();
    }

    private function filterQuery(array $params): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('trabajador')
            ->select(['trabajador', 'config'])
            ->join('trabajador.config', 'config')
        ;

        $this->security->configQuery($queryBuilder, true);

        Paginator::queryTexts($queryBuilder, $params, ['trabajador.nombre', 'trabajador.apellidos']);

        return $queryBuilder;
    }
}
