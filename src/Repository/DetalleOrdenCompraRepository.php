<?php

namespace Pidia\Apps\Demo\Repository;

use Pidia\Apps\Demo\Entity\DetalleOrdenCompra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Pidia\Apps\Demo\Security\Security;
use Pidia\Apps\Demo\Util\Paginator;

/***
 * @method DetalleOrdenCompra|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetalleOrdenCompra|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetalleOrdenCompra[]    findAll()
 * @method DetalleOrdenCompra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetalleOrdenCompraRepository extends ServiceEntityRepository implements BaseRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, DetalleOrdenCompra::class);
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
        $queryBuilder = $this->createQueryBuilder('detalleOrdenCompra')
            ->select(['detalleOrdenCompra', 'config'])
            ->join('detalleOrdenCompra.config', 'config')
        ;

        $this->security->configQuery($queryBuilder, true);

        Paginator::queryTexts($queryBuilder, $params, ['detalleOrdenCompra.producto']);

        return $queryBuilder;
    }

    public function valuesGroupingProductos(int $id): array
    {
        $queryBuilder = $this->createQueryBuilder('doc')
            ->select('al.nombre as almacen')
            ->addSelect('p.nombre as producto')
            ->addSelect('SUM(doc.cantRecibida) as stock')
            ->join('doc.producto', 'p')
            ->join('doc.ordenCompra', 'oc')
            ->join('oc.almacen', 'al')
            ->groupBy('al.nombre')
            ->addGroupBy('p.nombre')
            ->where('oc.activo = true')
            ->andWhere('p.activo = true')
            ->andWhere('al.id = :almacen_id')
            ->setParameter('almacen_id', $id)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
