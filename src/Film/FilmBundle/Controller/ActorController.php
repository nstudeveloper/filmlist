<?php

namespace Film\FilmBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Film\FilmBundle\Entity\Actor;
use Film\FilmBundle\Form\ActorType;

class ActorController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $actors = $em->getRepository('FilmBundle:Actor')->findAll();

        $actors = $this->get('knp_paginator')
            ->paginate(
                $actors, $request->query->getInt('page', 1), 3
            );

        return $this->render('FilmBundle:Actor:index.html.twig', array(
            'actors' => $actors,
        ));
    }

    public function newAction(Request $request)
    {
        $actor = new Actor();
        $form = $this->createForm(new ActorType(), $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actor);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Actor was successful created');

            return $this->redirectToRoute('actor_index');
        }

        return $this->render('FilmBundle:Actor:new.html.twig', array(
            'actor' => $actor,
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, Actor $actor)
    {
        $deleteForm = $this->createDeleteForm($actor);
        $editForm = $this->createForm('Film\FilmBundle\Form\ActorType', $actor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actor);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Actor was successful edited');

            return $this->redirectToRoute('actor_index');
        }

        return $this->render('FilmBundle:Actor:edit.html.twig', array(
            'actor' => $actor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Actor $actor)
    {

        $form = $this->createDeleteForm($actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actor);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Actor was successful deleted');
        }

        return $this->redirectToRoute('actor_index');
    }

    private function createDeleteForm(Actor $actor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actor_delete', array('id' => $actor->getId())))
            ->setMethod('POST')
            ->getForm();
    }
}
