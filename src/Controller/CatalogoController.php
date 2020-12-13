<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Repository\ArticuloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\CarritoController;

class CatalogoController extends AbstractController
{
    /**
     * @Route("/", name="catalogo")
     */
    public function index(ArticuloRepository $articuloRepository): Response
    {
        return $this->render('catalogo/index.html.twig', [
            'articulos' => $articuloRepository->findAll(),
        ]);
    }
}
