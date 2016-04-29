<?php

namespace Application\Provider;

use Application\Support\RouterResolver;
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
            $request = $app->get('request');

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
        $config = $app->get('config');
        $scope = $config->get('scope');
        $error_controller = "Application\\Controller\\$scope\\ErrorController";
        $app->share($error_controller)
            ->withMethodCall('setView', ['view'])
            ->withMethodCall('setHeader', ['header'])
            ->withMethodCall('iniController');

        $resolver = new RouterResolver($app);

        try {
            return $app->get('router')->dispatchRequest($request->getMethod(), $request->getUri(), $resolver);
        } catch (HttpRouteNotFoundException $e) {
            return $app->get($error_controller)->error404();
        } catch (HttpMethodNotAllowedException $e) {
            return $app->get($error_controller)->error405();
        } catch (\Exception $e) {
            return $app->get($error_controller)->error500($e);
        }

    }

}