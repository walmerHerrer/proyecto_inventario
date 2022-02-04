<?php

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace Pidia\Apps\Demo\Controller;

use Pidia\Apps\Demo\Cache\CategoriaCache;
use Pidia\Apps\Demo\Entity\Categoria;
use Pidia\Apps\Demo\Form\CategoriaType;
use Pidia\Apps\Demo\Manager\CategoriaManager;
use Pidia\Apps\Demo\Security\Access;
use Pidia\Apps\Demo\Util\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/categoria')]
class CategoriaController extends BaseController
{
    #[Route(path: '/', name: 'categoria_index', defaults: ['page' => '1'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'categoria_index_paginated', methods: ['GET'])]
    public function index(Request $request, int $page, CategoriaManager $manager): Response
    {
        $this->denyAccess(Access::LIST, 'categoria_index');
        $paginator = $manager->list($request->query->all(), $page);

        return $this->render(
            'categoria/index.html.twig',
            [
                'paginator' => $paginator,
            ]
        );
    }

    #[Route(path: '/export', methods: ['GET'], name: 'categoria_export')]
    public function export(Request $request, CategoriaManager $manager): Response
    {
        $this->denyAccess(Access::EXPORT, 'categoria_index');
        $headers = [
            'nombre' => 'Nombre',
            'detalle' => 'Detalle',
            'activo' => 'Activo',
        ];
        $params = Paginator::params($request->query->all());
        $objetos = $manager->repositorio()->filter($params, false);
        $data = [];
        /** @var Categoria $objeto */
        foreach ($objetos as $objeto) {
            $item = [];
            $item['nombre'] = $objeto->getNombre();
            $item['detalle'] = $objeto->getDetalle();
            $item['activo'] = $objeto->activo();
            $data[] = $item;
            unset($item);
        }

        return $manager->export($data, $headers, 'Reporte', 'categoria');
    }

    #[Route(path: '/new', name: 'categoria_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriaManager $manager, CategoriaCache $cache): Response
    {
        $this->denyAccess(Access::NEW, 'categoria_index');
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categoria->setPropietario($this->getUser());
            if ($manager->save($categoria)) {
                $cache->update();
                $this->addFlash('success', 'Registro creado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('categoria_index');
        }

        return $this->render(
            'categoria/new.html.twig',
            [
                'categoria' => $categoria,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'categoria_show', methods: ['GET'])]
    public function show(Categoria $categoria): Response
    {
        $this->denyAccess(Access::VIEW, 'categoria_index');

        return $this->render('categoria/show.html.twig', ['categoria' => $categoria]);
    }

    #[Route(path: '/{id}/edit', name: 'categoria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categoria $categoria, CategoriaManager $manager, CategoriaCache $cache): Response
    {
        $this->denyAccess(Access::EDIT, 'categoria_index');
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($manager->save($categoria)) {
                $cache->update();
                $this->addFlash('success', 'Registro actualizado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('categoria_index', ['id' => $categoria->getId()]);
        }

        return $this->render(
            'categoria/edit.html.twig',
            [
                'categoria' => $categoria,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'categoria_delete', methods: ['POST'])]
    public function delete(Request $request, Categoria $categoria, CategoriaManager $manager, CategoriaCache $cache): Response
    {
        $this->denyAccess(Access::DELETE, 'categoria_index');
        if ($this->isCsrfTokenValid('delete'.$categoria->getId(), $request->request->get('_token'))) {
            $categoria->changeActivo();
            if ($manager->save($categoria)) {
                $cache->update();
                $this->addFlash('success', 'Estado ha sido actualizado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('categoria_index');
    }

    #[Route(path: '/{id}/delete', name: 'categoria_delete_forever', methods: ['POST'])]
    public function deleteForever(Request $request, Categoria $categoria, CategoriaManager $manager, CategoriaCache $cache): Response
    {
        $this->denyAccess(Access::MASTER, 'categoria_index', $categoria);
        if ($this->isCsrfTokenValid('delete_forever'.$categoria->getId(), $request->request->get('_token'))) {
            if ($manager->remove($categoria)) {
                $cache->update();
                $this->addFlash('warning', 'Registro eliminado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('categoria_index');
    }
}
