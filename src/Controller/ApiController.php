<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

     /**
     * @Route("/index", name="index")
     */
    public function searchByName()
    {
        $client = new http\Client;
        $request = new http\Client\Request;

        $request->setRequestUrl('https://api.thecatapi.com/v1/breeds/search');
        $request->setRequestMethod('GET');
        $request->setHeaders(array(
        'x-api-key' => '1dbbd4d0-9763-45b0-ae18-a0231851e966'
        ));

        $client->enqueue($request)->send();
        $response = $client->getResponse();

        $body = $response->getBody();

        return $this->render('api/index.html.twig', [
            'body' => $body,
        ]);
    }


}
