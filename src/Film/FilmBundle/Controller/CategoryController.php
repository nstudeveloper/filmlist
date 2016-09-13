<?php

namespace Film\FilmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Film\FilmBundle\Entity\Category;

class CategoryController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('FilmBundle:Category')->findAll();

        $categories = $this->get('knp_paginator')
            ->paginate(
                $categories, $request->query->getInt('page', 1), 5
            );

        return $this->render('FilmBundle:Category:index.html.twig', array(
            'categories' => $categories,
        ));
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('FilmBundle:Category')->getCategories(20);

        return $this->render('FilmBundle:Category:list.html.twig', array(
            'categories' => $categories,
        ));
    }

    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('Film\FilmBundle\Form\CategoryType', $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Category was successful created');

            return $this->redirectToRoute('category_index');
        }

        return $this->render('FilmBundle:Category:new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('Film\FilmBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Category was successful edited');

            return $this->redirectToRoute('category_index');
        }

        return $this->render('FilmBundle:Category:edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Category was successful deleted');
        }

        return $this->redirectToRoute('category_index');
    }

    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
            ->setMethod('POST')
            ->getForm();
    }
}
