<?php

namespace App\Provider;

use App\Support\RouterResolver;
use Buuum\Exception\HttpMethodNotAllowedException;
use Buuum\Exception\HttpRouteNotFoundException;
use League\Container\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class DispatchProvider
{
    public function register(Container $app)
    {
        $app->share('dispatch', function () use ($app) {
            $request = $app->get('current_request');

            $response = $this->wrapResponse($this->dispatch($app, $request));

            //// Head responses should not return a content body
            $request->isMethod('head') and $response->setContent(null);

            if(!$request->cookies->get('accept-cookies')){
                $response->headers->setCookie(new Cookie('accept-cookies', true, time() + (24 * 60 * 60 * 100)));
            }

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
        return $app->get('router')->dispatchRequest($request->getMethod(), $request->getUri(), $resolver);
    }
}
