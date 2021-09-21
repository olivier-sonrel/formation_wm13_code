<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function helloWorld(Request $request): Response
    {
        return new Response('Hello World!');
    }

    /**
     * @Route("/slut", name="acceuil-slut")
     */
    public function helloSlut(): Response
    {
        return new Response("Hello slut!");
    }

    /**
     * @Route("/slut/{name}", name="acceuil-name")
     */
    public function helloName($name)
    {
        return $this->render('hello.html.twig', ['name' => $name]);
    }

}