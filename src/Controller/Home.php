<?php declare(strict_types=1);

namespace App\Controller;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Labrador\Web\Controller\HttpController;
use Labrador\Web\Controller\SelfDescribingController;
use Labrador\Web\Router\GetMapping;
use League\Plates\Engine as TemplateEngine;

#[HttpController(new GetMapping('/'))]
final class Home extends SelfDescribingController {

    public function __construct(
        private readonly TemplateEngine $templates
    ) {}

    public function handleRequest(Request $request) : Response {
        return new Response(
            headers: ['Content-Type' => 'text/html; charset=utf-8'],
            body: $this->templates->render('home')
        );
    }

}
