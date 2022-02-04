<?php

namespace Pidia\Apps\Demo\Controller;

use Pidia\Apps\Demo\Entity\Cliente;
use Pidia\Apps\Demo\Form\ClienteType;
use Pidia\Apps\Demo\Manager\ClienteManager;
use Pidia\Apps\Demo\Security\Access;
use Pidia\Apps\Demo\Util\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/cliente')]
class ClienteController extends BaseController
{
    #[Route(path: '/', name: 'cliente_index', defaults: ['page' => '1'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'cliente_index_paginated', methods: ['GET'])]
    public function index(Request $request, int $page, ClienteManager $manager): Response
    {
        $this->denyAccess(Access::LIST, 'cliente_index');
        $paginator = $manager->list($request->query->all(), $page);

        return $this->render(
            'cliente/index.html.twig',
            [
                'paginator' => $paginator,
            ]
        );
    }

    #[Route(path: '/export', name: 'cliente_export', methods: ['GET'])]
    public function export(Request $request, ClienteManager $manager): Response
    {
        $this->denyAccess(Access::EXPORT, 'cliente_index');
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
        /** @var cliente $objeto */
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

        return $manager->export($data, $headers, 'Reporte', 'cliente');
    }

    #[Route(path: '/new', name: 'cliente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ClienteManager $manager): Response
    {
        $this->denyAccess(Access::NEW, 'cliente_index');
        $cliente = new cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cliente->setPropietario($this->getUser());
            if ($manager->save($cliente)) {
                $this->addFlash('success', 'Registro creado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('cliente_index');
        }

        return $this->render(
            'cliente/new.html.twig',
            [
                'cliente' => $cliente,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'cliente_show', methods: ['GET'])]
    public function show(cliente $cliente): Response
    {
        $this->denyAccess(Access::VIEW, 'cliente_index');

        return $this->render('cliente/show.html.twig', ['cliente' => $cliente]);
    }

    #[Route(path: '/{id}/edit', name: 'cliente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, cliente $cliente, ClienteManager $manager): Response
    {
        $this->denyAccess(Access::EDIT, 'cliente_index');
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($manager->save($cliente)) {
                $this->addFlash('success', 'Registro actualizado!!!');
            } else {
                $this->addErrors($manager->errors());
            }

            return $this->redirectToRoute('cliente_index', ['id' => $cliente->getId()]);
        }

        return $this->render(
            'cliente/edit.html.twig',
            [
                'cliente' => $cliente,
                'form' => $form->createView(),
            ]
        );
    }

    #[Route(path: '/{id}', name: 'cliente_delete', methods: ['POST'])]
    public function delete(Request $request, cliente $cliente, ClienteManager $manager): Response
    {
        $this->denyAccess(Access::DELETE, 'cliente_index');
        if ($this->isCsrfTokenValid('delete'.$cliente->getId(), $request->request->get('_token'))) {
            $cliente->changeActivo();
            if ($manager->save($cliente)) {
                $this->addFlash('success', 'Estado ha sido actualizado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('cliente_index');
    }

    #[Route(path: '/{id}/delete', name: 'cliente_delete_forever', methods: ['POST'])]
    public function deleteForever(Request $request, cliente $cliente, ClienteManager $manager): Response
    {
        $this->denyAccess(Access::MASTER, 'cliente_index', $cliente);
        if ($this->isCsrfTokenValid('delete_forever'.$cliente->getId(), $request->request->get('_token'))) {
            if ($manager->remove($cliente)) {
                $this->addFlash('warning', 'Registro eliminado');
            } else {
                $this->addErrors($manager->errors());
            }
        }

        return $this->redirectToRoute('cliente_index');
    }
}
