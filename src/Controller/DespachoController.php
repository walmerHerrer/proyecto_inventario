<?php

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace Pidia\Apps\Demo\Controller;

use Pidia\Apps\Demo\Entity\Despacho;
use Pidia\Apps\Demo\Form\DespachoType;
use Pidia\Apps\Demo\Manager\DespachoManager;
use Pidia\Apps\Demo\Security\Access;
use Pidia\Apps\Demo\Util\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/despacho')]
class DespachoController extends BaseController
{
    #[Route(path: '/', name: 'despacho_index', defaults: ['page' => '1'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'despacho_index_paginated', methods: ['GET'])]
    public function index(Request $request, int $page, DespachoManager $manager): Response
    {
        $this->denyAccess(Access::LIST, 'despacho_index');
        $paginator = $manager->list($request->query->all(), $page);

        return $this->render(
            'despacho/index.html.twig',
            [
                'paginator' => $paginator,
            ]
        );
    }

    #[Route(path: '/export', methods: ['GET'], name: 'despacho_export')]
    public function export(Request $request, DespachoManager $manager): Response
    {
        $this->denyAccess(Access::EXPORT, 'despacho_index');
        $headers = [
            'trabajador' => 'Trabajador',
            'alamcen' => 'Almacen',
            'fechaSalida' => 'FechaSalida',
            'itemsDesapachados' => 'ItemsDespachos',
            'cantidadDespacho' => 'CantidadDespacho',
            'activo' => 'Activo',
        ];
        $params = Paginator::params($request->query->all());
        $objetos = $manager->repositorio()->filter($params, false);
        $data = [];
        /** @var Despacho $objeto */
        foreach ($objetos as $objeto) {
            $item = [];
            $item['tabajador'] = $objeto->getTrabajador();
            $item['alamcen'] = $objeto->getAlmacen();
            $item['fechasalida'] = $objeto->getFechaSalida();
            $item['itemsDesapachados'] = $objeto->getItemsDesapachados();
            $item['cantidadDespacho'] = $objeto->getCantidadDespacho();
            $item['activo'] = $objeto->activo();
            $data[] = $item;
            unset($item);
        }

        return $manager->export($data, $headers, 'Reporte', 'despacho');
    }

    #[Route(path: '/new', name: 'despacho_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DespachoManager $manager): Response
    {
        $this->denyAccess(Access::NEW, 'despacho_index');
        $despacho = new Despacho();
        $form = $this->createForm(DespachoType::class, $despacho);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $despacho->setPropietario($this->getUser());
            if ($manager->save($despacho)) {
                $this->addFlash('success', 'Registro creado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('despacho_index');
        }

        return $this->render(
            'despacho/new.html.twig',
            [
                'despacho' => $despacho,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'despacho_show', methods: ['GET'])]
    public function show(Despacho $despacho): Response
    {
        $this->denyAccess(Access::VIEW, 'despacho_index');

        return $this->render('despacho/show.html.twig', ['despacho' => $despacho]);
    }

    #[Route(path: '/{id}/edit', name: 'despacho_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Despacho $despacho, DespachoManager $manager): Response
    {
        $this->denyAccess(Access::EDIT, 'despacho_index');
        $form = $this->createForm(DespachoType::class, $despacho);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($manager->save($despacho)) {
                $this->addFlash('success', 'Registro actualizado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('despacho_index', ['id' => $despacho->getId()]);
        }

        return $this->render(
            'despacho/edit.html.twig',
            [
                'despacho' => $despacho,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'despacho_delete', methods: ['POST'])]
    public function delete(Request $request, Despacho $despacho, DespachoManager $manager): Response
    {
        $this->denyAccess(Access::DELETE, 'despacho_index');
        if ($this->isCsrfTokenValid('delete'.$despacho->getId(), $request->request->get('_token'))) {
            $despacho->changeActivo();
            if ($manager->save($despacho)) {
                $this->addFlash('success', 'Estado ha sido actualizado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('despacho_index');
    }

    #[Route(path: '/{id}/delete', name: 'despacho_delete_forever', methods: ['POST'])]
    public function deleteForever(Request $request, Despacho $despacho, DespachoManager $manager): Response
    {
        $this->denyAccess(Access::MASTER, 'despacho_index', $despacho);
        if ($this->isCsrfTokenValid('delete_forever'.$despacho->getId(), $request->request->get('_token'))) {
            if ($manager->remove($despacho)) {
                $this->addFlash('warning', 'Registro eliminado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('despacho_index');
    }
}
