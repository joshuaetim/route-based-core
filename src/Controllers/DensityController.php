<?php declare(strict_types=1);

namespace Core\Controllers;

use Core\Controllers\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DensityController extends BaseController
{
    public function greet(ServerRequestInterface $request): ResponseInterface
    {
        $response = new \Laminas\Diactoros\Response();
        $response->getBody()->write('<h2>From Density Controller</h2>');
        return $response;
    }

    public function showForm(ServerRequestInterface $request): ResponseInterface
    {
        $response = new \Laminas\Diactoros\Response();
        $file = file_get_contents(dirname(dirname(__DIR__)).'/views/form.php');
        $response->getBody()->write($file);
        return $response;
    }
}