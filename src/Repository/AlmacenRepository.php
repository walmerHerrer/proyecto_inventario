<?php

namespace Pidia\Apps\Demo\Repository;

use Pidia\Apps\Demo\Entity\Almacen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Pidia\Apps\Demo\Security\Security;
use Pidia\Apps\Demo\Util\Paginator;

/**
 * @method Almacen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Almacen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Almacen[]    findAll()
 * @method Almacen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlmacenRepository extends ServiceEntityRepository implements BaseRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Almacen::class);
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
        $queryBuilder = $this->createQueryBuilder('almacen')
            ->select(['almacen', 'config'])
            ->join('almacen.config', 'config')
        ;

        $this->security->configQuery($queryBuilder, true);

        Paginator::queryTexts($queryBuilder, $params, ['almacen.nombre']);

        return $queryBuilder;
    }
    public function valuesGroupingProductos(int $id): array
    {
        
        $queryBuilder = $this->QueryBuilder('al')
            ->select('al.nombre as almacen')
            ->addSelect('p.nombre as producto')
            ->addSelect('SUM(doc.cantRecibida) as stock')
            ->from(OrdenCompra::class, 'doc')
            ->join('doc.producto', 'p')
            ->join('doc.ordenCompra', 'oc')
            ->join('oc.almacen', 'al')
            ->groupBy('al.nombre')
            ->groupBy('p.nombre')
            // ->where('almacen.id = :almacen_id')
            ->setParameter('almacen_id', $id)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
