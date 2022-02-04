<?php

namespace Pidia\Apps\Demo\Controller;

use Pidia\Apps\Demo\Cache\ProveedorCache;
use Pidia\Apps\Demo\Entity\Proveedor;
use Pidia\Apps\Demo\Form\ProveedorType;
use Pidia\Apps\Demo\Manager\ProveedorManager;
use Pidia\Apps\Demo\Security\Access;
use Pidia\Apps\Demo\Util\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/proveedor')]
class ProveedorController extends BaseController
{
    #[Route(path: '/', name: 'proveedor_index', defaults: ['page' => '1'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'proveedor_index_paginated', methods: ['GET'])]
    public function index(Request $request, int $page, ProveedorManager $manager): Response
    {
        $this->denyAccess(Access::LIST, 'proveedor_index');
        $paginator = $manager->list($request->query->all(), $page);

        return $this->render(
            'proveedor/index.html.twig',
            [
                'paginator' => $paginator,
            ]
        );
    }

    #[Route(path: '/export', name: 'proveedor_export', methods: ['GET'])]
    public function export(Request $request, ProveedorManager $manager): Response
    {
        $this->denyAccess(Access::EXPORT, 'proveedor_index');
        $headers = [
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'dni' => 'Dni',
            'activo' => 'Activo',
        ];
        $params = Paginator::params($request->query->all());
        $objetos = $manager->repositorio()->filter($params, false);
        $data = [];
        /** @var proveedor $objeto */
        foreach ($objetos as $objeto) {
            $item = [];
            $item['nombre'] = $objeto->getNombre();
            $item['apellidos'] = $objeto->getApellidos();  
            $item['telefono'] = $objeto->getTelefono();
            $item['direccion'] = $objeto->getDireccion();
            $item['dni'] = $objeto->getDni();
            $item['activo'] = $objeto->activo();
            $data[] = $item;
            unset($item);
        }

        return $manager->export($data, $headers, 'Reporte', 'proveedor');
    }

    #[Route(path: '/new', name: 'proveedor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProveedorManager $manager, ProveedorCache $cache): Response
    {
        $this->denyAccess(Access::NEW, 'proveedor_index');
        $proveedor = new proveedor();
        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $proveedor->setPropietario($this->getUser());
            if ($manager->save($proveedor)) {
                $cache->update();
                $this->addFlash('success', 'Registro creado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('proveedor_index');
        }

        return $this->render(
            'proveedor/new.html.twig',
            [
                'proveedor' => $proveedor,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'proveedor_show', methods: ['GET'])]
    public function show(proveedor $proveedor): Response
    {
        $this->denyAccess(Access::VIEW, 'proveedor_index');

        return $this->render('proveedor/show.html.twig', ['proveedor' => $proveedor]);
    }

    #[Route(path: '/{id}/edit', name: 'proveedor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, proveedor $proveedor, ProveedorManager $manager, ProveedorCache $cache): Response
    {
        $this->denyAccess(Access::EDIT, 'proveedor_index');
        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($manager->save($proveedor)) {
                $cache->update();
                $this->addFlash('success', 'Registro actualizado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('proveedor_index', ['id' => $proveedor->getId()]);
        }

        return $this->render(
            'proveedor/edit.html.twig',
            [
                'proveedor' => $proveedor,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'proveedor_delete', methods: ['POST'])]
    public function delete(Request $request, proveedor $proveedor, ProveedorManager $manager, ProveedorCache $cache): Response
    {
        $this->denyAccess(Access::DELETE, 'proveedor_index');
        if ($this->isCsrfTokenValid('delete'.$proveedor->getId(), $request->request->get('_token'))) {
            $proveedor->changeActivo();
            if ($manager->save($proveedor)) {
                $cache->update();
                $this->addFlash('success', 'Estado ha sido actualizado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('proveedor_index');
    }

    #[Route(path: '/{id}/delete', name: 'proveedor_delete_forever', methods: ['POST'])]
    public function deleteForever(Request $request, proveedor $proveedor, ProveedorManager $manager, ProveedorCache $cache): Response
    {
        $this->denyAccess(Access::MASTER, 'proveedor_index', $proveedor);
        if ($this->isCsrfTokenValid('delete_forever'.$proveedor->getId(), $request->request->get('_token'))) {
            if ($manager->remove($proveedor)) {
                $cache->update();
                $this->addFlash('warning', 'Registro eliminado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('proveedor_index');
    }
}
