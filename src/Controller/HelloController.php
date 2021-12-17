<?php

namespace App\Controller;

use App\HTTP\Request\RequestSchema;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello", methods={"POST"})
     */
    public function index(Request $request, RequestSchema $requestSchema)
    {
        $request = $requestSchema->getRequestProperty(Hello::class, $request);
        return $this->json($request->name);
    }
}
