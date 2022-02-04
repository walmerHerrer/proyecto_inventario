<?php

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace Pidia\Apps\Demo\Controller;

use Pidia\Apps\Demo\Entity\OrdenCompra;
use Pidia\Apps\Demo\Form\OrdenCompraType;
use Pidia\Apps\Demo\Manager\OrdenCompraManager;
use Pidia\Apps\Demo\Security\Access;
use Pidia\Apps\Demo\Util\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/ordenCompra')]
class OrdenCompraController extends BaseController
{
    #[Route(path: '/', name: 'ordenCompra_index', defaults: ['page' => '1'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'ordenCompra_index_paginated', methods: ['GET'])]
    public function index(Request $request, int $page, OrdenCompraManager $manager): Response
    {
        $this->denyAccess(Access::LIST, 'ordenCompra_index');
        $paginator = $manager->list($request->query->all(), $page);

        return $this->render(
            'ordenCompra/index.html.twig',
            [
                'paginator' => $paginator,
            ]
        );
    }

    #[Route(path: '/export', methods: ['GET'], name: 'ordenCompra_export')]
    public function export(Request $request, OrdenCompraManager $manager): Response
    {
        $this->denyAccess(Access::EXPORT, 'ordenCompra_index');
        $headers = [
            'trabajador' => 'Trabajador',
            'proveedor' => 'Proveedor',
            'fecha' => 'Fecha',
            'precioOrden' => 'PrecioOrden',
            'cantidadOrden' => 'CantidadOrden',
            'activo' => 'Activo',
        ];
        $params = Paginator::params($request->query->all());
        $objetos = $manager->repositorio()->filter($params, false);
        $data = [];
        /** @var OrdenCompra $objeto */
        foreach ($objetos as $objeto) {
            $item = [];
            $item['tabajador'] = $objeto->getTrabajador();
            $item['proveedor'] = $objeto->getProveedor();
            $item['fecha'] = $objeto->getFecha();
            $item['precioOrden'] = $objeto->getPrecioOrden();
            $item['cantidadOrden'] = $objeto->getCantidadOrden();
            $item['activo'] = $objeto->activo();
            $data[] = $item;
            unset($item);
        }

        return $manager->export($data, $headers, 'Reporte', 'ordenCompra');
    }

    #[Route(path: '/new', name: 'ordenCompra_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OrdenCompraManager $manager): Response
    {
        $this->denyAccess(Access::NEW, 'ordenCompra_index');
        $ordenCompra = new OrdenCompra();
        $form = $this->createForm(OrdenCompraType::class, $ordenCompra);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ordenCompra->setPropietario($this->getUser());
            if ($manager->save($ordenCompra)) {
                $this->addFlash('success', 'Registro creado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('ordenCompra_index');
        }

        return $this->render(
            'ordenCompra/new.html.twig',
            [
                'ordenCompra' => $ordenCompra,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'ordenCompra_show', methods: ['GET'])]
    public function show(OrdenCompra $ordenCompra): Response
    {
        $this->denyAccess(Access::VIEW, 'ordenCompra_index');

        return $this->render('ordenCompra/show.html.twig', ['ordenCompra' => $ordenCompra]);
    }

    #[Route(path: '/{id}/edit', name: 'ordenCompra_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OrdenCompra $ordenCompra, OrdenCompraManager $manager): Response
    {
        $this->denyAccess(Access::EDIT, 'ordenCompra_index');
        $form = $this->createForm(OrdenCompraType::class, $ordenCompra);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($manager->save($ordenCompra)) {
                $this->addFlash('success', 'Registro actualizado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('ordenCompra_index', ['id' => $ordenCompra->getId()]);
        }

        return $this->render(
            'ordenCompra/edit.html.twig',
            [
                'ordenCompra' => $ordenCompra,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'ordenCompra_delete', methods: ['POST'])]
    public function delete(Request $request, OrdenCompra $ordenCompra, OrdenCompraManager $manager): Response
    {
        $this->denyAccess(Access::DELETE, 'ordenCompra_index');
        if ($this->isCsrfTokenValid('delete'.$ordenCompra->getId(), $request->request->get('_token'))) {
            $ordenCompra->changeActivo();
            if ($manager->save($ordenCompra)) {
                $this->addFlash('success', 'Estado ha sido actualizado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('ordenCompra_index');
    }

    #[Route(path: '/{id}/delete', name: 'ordenCompra_delete_forever', methods: ['POST'])]
    public function deleteForever(Request $request, OrdenCompra $ordenCompra, OrdenCompraManager $manager): Response
    {
        $this->denyAccess(Access::MASTER, 'ordenCompra_index', $ordenCompra);
        if ($this->isCsrfTokenValid('delete_forever'.$ordenCompra->getId(), $request->request->get('_token'))) {
            if ($manager->remove($ordenCompra)) {
                $this->addFlash('warning', 'Registro eliminado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('ordenCompra_index');
    }
}
