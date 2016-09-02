<?php

namespace Film\FilmBundle\Controller;


use Film\FilmBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class FormExampleController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $product = $form->getData();

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'We saved a film with id ' . $product->getId());
        }

        return $this->render('FilmBundle:Form-example:index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}