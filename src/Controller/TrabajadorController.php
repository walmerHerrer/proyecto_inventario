<?php

namespace Pidia\Apps\Demo\Controller;

use Pidia\Apps\Demo\Cache\TrabajadorCache;
use Pidia\Apps\Demo\Entity\Trabajador;
use Pidia\Apps\Demo\Form\TrabajadorType;
use Pidia\Apps\Demo\Manager\TrabajadorManager;
use Pidia\Apps\Demo\Security\Access;
use Pidia\Apps\Demo\Util\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/trabajador')]
class TrabajadorController extends BaseController
{
    #[Route(path: '/', name: 'trabajador_index', defaults: ['page' => '1'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'trabajador_index_paginated', methods: ['GET'])]
    public function index(Request $request, int $page, TrabajadorManager $manager): Response
    {
        $this->denyAccess(Access::LIST, 'trabajador_index');
        $paginator = $manager->list($request->query->all(), $page);

        return $this->render(
            'trabajador/index.html.twig',
            [
                'paginator' => $paginator,
            ]
        );
    }

    #[Route(path: '/export', name: 'trabajador_export', methods: ['GET'])]
    public function export(Request $request, TrabajadorManager $manager): Response
    {
        $this->denyAccess(Access::EXPORT, 'trabajador_index');
        $headers = [
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'dni' => 'Dni',
            'cargo' => 'cargo',
            'activo' => 'Activo',
        ];
        $params = Paginator::params($request->query->all());
        $objetos = $manager->repositorio()->filter($params, false);
        $data = [];
        /** @var trabajador $objeto */
        foreach ($objetos as $objeto) {
            $item = [];
            $item['nombre'] = $objeto->getNombre();
            $item['apellidos'] = $objeto->getApellidos();  
            $item['telefono'] = $objeto->getTelefono();
            $item['direccion'] = $objeto->getDireccion();
            $item['dni'] = $objeto->getDni();
            $item['cargo'] = $objeto->getCargo();
            $item['activo'] = $objeto->activo();
            $data[] = $item;
            unset($item);
        }

        return $manager->export($data, $headers, 'Reporte', 'trabajador');
    }

    #[Route(path: '/new', name: 'trabajador_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TrabajadorManager $manager, TrabajadorCache $cache): Response
    {
        $this->denyAccess(Access::NEW, 'trabajador_index');
        $trabajador = new trabajador();
        $form = $this->createForm(TrabajadorType::class, $trabajador);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $trabajador->setPropietario($this->getUser());
            if ($manager->save($trabajador)) {
                $cache->update();
                $this->addFlash('success', 'Registro creado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('trabajador_index');
        }

        return $this->render(
            'trabajador/new.html.twig',
            [
                'trabajador' => $trabajador,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'trabajador_show', methods: ['GET'])]
    public function show(trabajador $trabajador): Response
    {
        $this->denyAccess(Access::VIEW, 'trabajador_index');

        return $this->render('trabajador/show.html.twig', ['trabajador' => $trabajador]);
    }

    #[Route(path: '/{id}/edit', name: 'trabajador_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, trabajador $trabajador, TrabajadorManager $manager, TrabajadorCache $cache): Response
    {
        $this->denyAccess(Access::EDIT, 'trabajador_index');
        $form = $this->createForm(TrabajadorType::class, $trabajador);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($manager->save($trabajador)) {
                $cache->update();
                $this->addFlash('success', 'Registro actualizado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('trabajador_index', ['id' => $trabajador->getId()]);
        }

        return $this->render(
            'trabajador/edit.html.twig',
            [
                'trabajador' => $trabajador,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'trabajador_delete', methods: ['POST'])]
    public function delete(Request $request, trabajador $trabajador, TrabajadorManager $manager, TrabajadorCache $cache): Response
    {
        $this->denyAccess(Access::DELETE, 'trabajador_index');
        if ($this->isCsrfTokenValid('delete'.$trabajador->getId(), $request->request->get('_token'))) {
            $trabajador->changeActivo();
            if ($manager->save($trabajador)) {
                $cache->update();
                $this->addFlash('success', 'Estado ha sido actualizado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('trabajador_index');
    }

    #[Route(path: '/{id}/delete', name: 'trabajador_delete_forever', methods: ['POST'])]
    public function deleteForever(Request $request, trabajador $trabajador, TrabajadorManager $manager, TrabajadorCache $cache): Response
    {
        $this->denyAccess(Access::MASTER, 'trabajador_index', $trabajador);
        if ($this->isCsrfTokenValid('delete_forever'.$trabajador->getId(), $request->request->get('_token'))) {
            if ($manager->remove($trabajador)) {
                $cache->update();
                $this->addFlash('warning', 'Registro eliminado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('trabajador_index');
    }
}
