<?php

namespace Film\FilmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Film\FilmBundle\Entity\Film;

class FilmController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('FilmBundle:Film')->findAll();

        $films = $this->get('knp_paginator')
            ->paginate(
                $films, $request->query->getInt('page', 1), 3
            );

        return $this->render('FilmBundle:Film:index.html.twig', [
            'films' => $films
        ]);
    }

    public function newAction(Request $request)
    {
        $film = new Film();
        $form = $this->createForm('Film\FilmBundle\Form\FilmType', $film);
        $form->handleRequest($request);
        $imageDir = $this->container->getParameter('images_directory');

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $film->getImage();
            if ($file != null) {
                $fileName = $this->get('film.image_uploader')->upload($file, $imageDir);
                $film->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'New film created successful');

            return $this->redirectToRoute('film_index', array('id' => $film->getId()));
        }

        return $this->render('FilmBundle:Film:new.html.twig', array(
            'film' => $film,
            'form' => $form->createView(),
        ));
    }

    public function showAction(Film $film)
    {
        $deleteForm = $this->createDeleteForm($film);

        return $this->render('FilmBundle:Film:show.html.twig', array(
            'film' => $film,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, Film $film)
    {
        $deleteForm = $this->createDeleteForm($film);
        $editForm = $this->createForm('Film\FilmBundle\Form\FilmType', $film);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $film->getImage();
            $fileName = $this->get('film.image_uploader')->upload($file);

            $film->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Film was successful edited');

            return $this->redirectToRoute('film_index', array('id' => $film->getId()));
        }

        return $this->render('FilmBundle:Film:edit.html.twig', array(
            'film' => $film,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Film $film)
    {
        $form = $this->createDeleteForm($film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($film);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Film was successful deleted');
        }

        return $this->redirectToRoute('film_index');
    }

    private function createDeleteForm(Film $film)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('film_delete', array('id' => $film->getId())))
            ->setMethod('POST')
            ->getForm();
    }

    public function showByCategoryIdAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('FilmBundle:Film')->getFilmsByCategoryId($id);

        $films = $this->get('knp_paginator')
            ->paginate(
                $films, $request->query->getInt('page', 1), 3
            );

        return $this->render('FilmBundle:Film:index.html.twig', [
            'films' => $films,
        ]);
    }

    public function showByActorIdAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('FilmBundle:Film')->getFilmsByActorId($id);

        $films = $this->get('knp_paginator')
            ->paginate(
                $films, $request->query->getInt('page', 1), 3
            );

        return $this->render('FilmBundle:Film:index.html.twig', [
            'films' => $films,
        ]);
    }
}
