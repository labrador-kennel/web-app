<?php declare(strict_types=1);

namespace App\Http\Controller;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Labrador\Web\Autowire\HttpController;
use Labrador\Web\Controller\SelfDescribingController;
use Labrador\Web\Router\Mapping\GetMapping;

#[HttpController(new GetMapping('/health-check'))]
class HealthCheck extends SelfDescribingController {

    public function handleRequest(Request $request) : Response {
        return new Response();
    }

}
