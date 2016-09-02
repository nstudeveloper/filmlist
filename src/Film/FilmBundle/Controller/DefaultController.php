<?php

namespace Film\FilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
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
}
