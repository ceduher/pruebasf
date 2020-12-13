<?php

namespace App\Controller;

use App\Entity\Carrito;
use App\Entity\Renglon;
use App\Entity\Articulo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carrito")
 */
class CarritoController extends AbstractController
{

    /**
     * @Route("/new", name="carrito_new", options={"expose"=true}, methods={"GET","POST"})
     */
    public function new(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $carrito = new Carrito();

        $carrito->setUsuario(2);//Visitante
        $carrito->setRenglones([]);
        $em->persist($carrito);
        $em->flush();

        return new Response(json_encode(array('id' => $carrito->getId())), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/{id}/show", name="carrito_show", options={"expose"=true}, methods={"GET","POST"})
     */
    public function show(Carrito $carrito): Response
    {
        $em = $this->getDoctrine()->getManager();
        $renglon = array();

        $precio_acu = 0;
        $cantidad_art = 0;
        foreach($carrito->getRenglones() as $linea){

            $reng = $em->getRepository(Renglon::class)->find($linea);
            $detArt = $em->getRepository(Articulo::class)->find($reng->getIdArticulo());

            $item = array();
            $item['id_articulo'] = $reng->getIdArticulo();
            $item['talla'] = $detArt->getTalla();
            $item['color'] = $detArt->getColor();
            $item['cantidad'] = $reng->getCantidad();
            $item['precio_uni'] = $detArt->getPrecioUni();

            //Ordenado de renglones por talla
            switch($item['talla']){
                case 'xs':
                    $renglon[0][] = $item;
                break;
                case 's':
                    $renglon[1][] = $item;
                break;
                case 'm':
                    $renglon[2][] = $item;
                break;
                case 'l':
                    $renglon[3][] = $item;
                break;
                case 'xl':
                    $renglon[4][] = $item;
                break;
                case 'xxl':
                    $renglon[5][] = $item;
                break;
            }
            
            $cantidad_art = $cantidad_art + $reng->getCantidad();
            $precio_acu = $precio_acu + ($reng->getCantidad() * $detArt->getPrecioUni());
        }

        //Calculo de envio
        $envio = 5;
        if($precio_acu > 50){
            $envio = 0;
        }

        //Generacion del pie del carrito
        $renglon['envio'] = $envio;
        $renglon['cantidad_art'] = $cantidad_art;
        $renglon['total'] = $precio_acu + $envio;

        return new Response(json_encode(array('renglones' => $renglon)), 200, ['Content-Type' => 'application/json']);
    }

    /**
     * Agrega un item al carrito.
     *
     * @Route("/agregar", name="carrito_agregar", options={"expose"=true}, methods={"GET","POST"})
     */
    public function agregarAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        //Agrega un nuevo renglon al carrito
        $renglon = new Renglon();
        $renglon->setIdArticulo($request->get('id'));
        $renglon->setCantidad($request->get('cantidad'));
        $em->persist($renglon);
        $em->flush();

        //Actualiza los renglones (array de id's) en el carrito
        $carrito = $em->getRepository(Carrito::class)->find($request->get('carrito'));
        $idRenglones = array();
        if (count((array)$carrito->getRenglones()) !== 0) {
            $idRenglones = $carrito->getRenglones();
        }
        array_push($idRenglones, $renglon->getId());
        $carrito->setRenglones($idRenglones);
        
        $em->flush();
        
        return new Response(json_encode(array('renglon' => $renglon->getId())), 200, ['Content-Type' => 'application/json']);
    }
}