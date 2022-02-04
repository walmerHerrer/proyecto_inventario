<?php

namespace Pidia\Apps\Demo\Repository;

use Pidia\Apps\Demo\Entity\OrdenPedido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Pidia\Apps\Demo\Security\Security;
use Pidia\Apps\Demo\Util\Paginator;

/**
 * @method OrdenPedido|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdenPedido|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdenPedido[]    findAll()
 * @method OrdenPedido[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdenPedidoRepository extends ServiceEntityRepository implements BaseRepository
{
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, OrdenPedido::class);
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
        $queryBuilder = $this->createQueryBuilder('ordenPedido')
            ->select(['ordenPedido', 'config'])
            ->join('ordenPedido.config', 'config')
        ;
        $this->security->configQuery($queryBuilder, true);

        Paginator::queryTexts($queryBuilder, $params, ['ordenPedido.almacen','ordenPedido.cliente', 'ordenPedido.trabajador']);

        return $queryBuilder;
    }
}
