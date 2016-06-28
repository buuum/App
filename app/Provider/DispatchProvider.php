<?php

namespace App\Provider;

use App\Support\RouterResolver;
use Buuum\Exception\HttpMethodNotAllowedException;
use Buuum\Exception\HttpRouteNotFoundException;
use League\Container\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DispatchProvider
{
    public function register(Container $app)
    {
        $app->share('dispatch', function () use ($app) {
            $request = $app->get('Symfony\Component\HttpFoundation\Request');

            $response = $this->wrapResponse($this->dispatch($app, $request));

            //// Head responses should not return a content body
            $request->isMethod('head') and $response->setContent(null);

            return $response;
        });
    }

    public function wrapResponse($response)
    {
        if (!$response instanceof Response) {
            $response = is_scalar($response) ? Response::create($response) : JsonResponse::create($response);
        }

        return $response;
    }

    public function dispatch(Container $app, Request $request)
    {
        $resolver = new RouterResolver($app);
        return $app->get('Buuum\Dispatcher')->dispatchRequest($request->getMethod(), $request->getUri(), $resolver);
    }

}