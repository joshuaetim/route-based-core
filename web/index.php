<?php declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require_once dirname(__DIR__).'/vendor/autoload.php';

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();
// $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

$router = new League\Route\Router();

$strategy = new League\Route\Strategy\JsonStrategy(new Laminas\Diactoros\ResponseFactory);

$router->get('/', function(ServerRequestInterface $request): ResponseInterface{
    $response = new Laminas\Diactoros\Response();
    $response->getBody()->write('<h2>From Router</h2>');
    return $response;
});

$router->get('/api', function(ServerRequestInterface $request): array{
    return [
        'name'=> 'Joshua',
        'age' => 20,
    ];
})->setStrategy($strategy);

$router->get('/control', [Core\Controllers\DensityController::class, 'greet']);

$router->get('/tool', [Core\Controllers\DensityController::class, 'showForm']);

$router->post('/tool/calculate', [Core\Controllers\DensityController::class, 'calculate']);

$router->get('/sandbox', function(ServerRequestInterface $request): ResponseInterface{
    $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__).'/views');
    $twig = new \Twig\Environment($loader);
    $content = $twig->render('form.html', ['name' => 'Fabien']);
    return new Laminas\Diactoros\Response\HtmlResponse($content);
});

$response = $router->dispatch($request);

$emitter = new Laminas\HttpHandlerRunner\Emitter\SapiEmitter();
$emitter->emit($response);