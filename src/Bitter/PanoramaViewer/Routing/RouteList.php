<?php

namespace Bitter\PanoramaViewer\Routing;

use Bitter\PanoramaViewer\API\V1\Middleware\FractalNegotiatorMiddleware;
use Bitter\PanoramaViewer\API\V1\Configurator;
use Concrete\Core\Routing\RouteListInterface;
use Concrete\Core\Routing\Router;

class RouteList implements RouteListInterface
{
    public function loadRoutes(Router $router)
    {
        $router
            ->buildGroup()
            ->setNamespace('Concrete\Package\PanoramaViewer\Controller\Dialog\Support')
            ->setPrefix('/ccm/system/dialogs/panorama_viewer')
            ->routes('dialogs/support.php', 'panorama_viewer');
    }
}