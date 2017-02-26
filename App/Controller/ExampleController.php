<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ExampleController extends AppController
{
    /**
     * Invokable class example
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $response->getBody()->write('called as a function');
        return $response;
    }
}
