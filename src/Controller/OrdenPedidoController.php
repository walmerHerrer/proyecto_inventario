<?php

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace Pidia\Apps\Demo\Controller;

use Pidia\Apps\Demo\Entity\OrdenPedido;
use Pidia\Apps\Demo\Form\OrdenPedidoType;
use Pidia\Apps\Demo\Manager\OrdenPedidoManager;
use Pidia\Apps\Demo\Security\Access;
use Pidia\Apps\Demo\Util\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/admin/ordenPedido')]
class OrdenPedidoController extends BaseController
{
    #[Route(path: '/', name: 'ordenPedido_index', defaults: ['page' => '1'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'ordenPedido_index_paginated', methods: ['GET'])]
    public function index(Request $request, int $page, OrdenPedidoManager $manager): Response
    {
        $this->denyAccess(Access::LIST, 'ordenPedido_index');
        $paginator = $manager->list($request->query->all(), $page);

        return $this->render(
            'ordenPedido/index.html.twig',
            [
                'paginator' => $paginator,
            ]
        );
    }

    #[Route(path: '/export', methods: ['GET'], name: 'ordenPedido_export')]
    public function export(Request $request, OrdenPedidoManager $manager): Response
    {
        $this->denyAccess(Access::EXPORT, 'ordenPedido_index');
        $headers = [
            'trabajador' => 'Trabajador',
            'almacen' => 'Almacen',
            'fechaPedido' => 'Fecha',
            'cantidadPedido' => 'Cantidad Pedido',
            'cantidadItems' => 'Cantidad Items',
            'activo' => 'Activo',
        ];
        $params = Paginator::params($request->query->all());
        $objetos = $manager->repositorio()->filter($params, false);
        $data = [];
        /** @var OrdenPedido $objeto */
        foreach ($objetos as $objeto) {
            $item = [];
            $item['tabajador'] = $objeto->getTrabajador();
            $item['almacen'] = $objeto->getAlmacen();
            $item['fechaPedido'] = $objeto->getFechaPedido();
            $item['activo'] = $objeto->activo();
            $data[] = $item;
            unset($item);
        }

        return $manager->export($data, $headers, 'Reporte', 'ordenPedido');
    }

    #[Route(path: '/new', name: 'ordenPedido_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OrdenPedidoManager $manager): Response
    {
        $this->denyAccess(Access::NEW, 'ordenPedido_index');
        $ordenPedido = new OrdenPedido();
        $form = $this->createForm(OrdenPedidoType::class, $ordenPedido);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ordenPedido->setPropietario($this->getUser());
            if ($manager->save($ordenPedido)) {
                $this->addFlash('success', 'Registro creado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('ordenPedido_index');
        }

        return $this->render(
            'ordenPedido/new.html.twig',
            [
                'ordenPedido' => $ordenPedido,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'ordenPedido_show', methods: ['GET'])]
    public function show(OrdenPedido $ordenPedido): Response
    {
        $this->denyAccess(Access::VIEW, 'ordenPedido_index');

        return $this->render('ordenPedido/show.html.twig', ['ordenPedido' => $ordenPedido]);
    }

    #[Route(path: '/{id}/edit', name: 'ordenPedido_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OrdenPedido $ordenPedido, OrdenPedidoManager $manager): Response
    {
        $this->denyAccess(Access::EDIT, 'ordenPedido_index');
        $form = $this->createForm(OrdenPedidoType::class, $ordenPedido);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($manager->save($ordenPedido)) {
                $this->addFlash('success', 'Registro actualizado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('ordenPedido_index', ['id' => $ordenPedido->getId()]);
        }

        return $this->render(
            'ordenPedido/edit.html.twig',
            [
                'ordenPedido' => $ordenPedido,
                'form' => $form->createView(),
            ]
        );
    }
    #[Route(path: '/{id}/despachar', name: 'ordenPedido_despachar', methods: ['GET', 'POST'])]
    public function despachar(Request $request, OrdenPedido $ordenPedido, OrdenPedidoManager $manager): Response
    {
        $this->denyAccess(Access::EDIT, 'ordenPedido_index');
        $form = $this->createForm(OrdenPedidoType::class, $ordenPedido);
        $form->handleRequest($request);
        

        return $this->redirectToRoute('ordenPedido_index');
    }
    #[Route('/reporteStock', name: 'ordenPedido_reporteStock', methods: ['GET'])]
    

    #[Route(path: '/{id}', name: 'ordenPedido_delete', methods: ['POST'])]
    public function delete(Request $request, OrdenPedido $ordenPedido, OrdenPedidoManager $manager): Response
    {
        $this->denyAccess(Access::DELETE, 'ordenPedido_index');
        if ($this->isCsrfTokenValid('delete'.$ordenPedido->getId(), $request->request->get('_token'))) {
            $ordenPedido->changeActivo();
            if ($manager->save($ordenPedido)) {
                $this->addFlash('success', 'Estado ha sido actualizado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('ordenPedido_index');
    }

    #[Route(path: '/{id}/delete', name: 'ordenPedido_delete_forever', methods: ['POST'])]
    public function deleteForever(Request $request, OrdenPedido $ordenPedido, OrdenPedidoManager $manager): Response
    {
        $this->denyAccess(Access::MASTER, 'ordenPedido_index', $ordenPedido);
        if ($this->isCsrfTokenValid('delete_forever'.$ordenPedido->getId(), $request->request->get('_token'))) {
            if ($manager->remove($ordenPedido)) {
                $this->addFlash('warning', 'Registro eliminado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('ordenPedido_index');
    }
}
