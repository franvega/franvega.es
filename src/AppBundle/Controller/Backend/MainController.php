<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        //$this->get('stats')->addInfo('importacion', 'sd');
        $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('send@example.com')
        ->setTo('recipient@example.com')
        ->setBody(
            'asdasd'
        );

        $this->get('mailer')->send($message);
        die;

    }

    /**
     * @Route("/buscar-plaza-de-garage", name="homepage")
     */
    public function busquedaAction()
    {
        return new Response('Buscar plaza de garage');


    }

    // /**
    //  * @Route("/producto/{id}", name="product")
    //  */
    // public function productAction($id)
    // {
    //     $apaiIo = $this->get('apaiio');
    //     $lookup = new \ApaiIO\Operations\Lookup();
    //     $lookup->setItemId('B00426FEL8');
    //     $lookup->setResponseGroup(array('Large', 'Small'));
    //     $product = $apaiIo->runOperation($lookup);
    //     dump($product);
    //     return $this->render('default/product.html.twig', ['product'=> $product->Items->Item]);

    // }
}
