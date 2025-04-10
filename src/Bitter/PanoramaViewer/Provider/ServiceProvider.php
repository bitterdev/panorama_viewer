<?php

namespace Bitter\PanoramaViewer\Provider;

use Concrete\Core\Application\Application;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Foundation\Service\Provider;
use Concrete\Core\Routing\RouterInterface;
use Bitter\PanoramaViewer\Routing\RouteList;

class ServiceProvider extends Provider
{
    protected RouterInterface $router;

    public function __construct(
        Application     $app,
        RouterInterface $router
    )
    {
        parent::__construct($app);

        $this->router = $router;
    }

    public function register()
    {
        $this->registerRoutes();
        $this->registerAssets();
    }

    private function registerAssets()
    {
        $al = AssetList::getInstance();
        $al->register('javascript', 'threejs', 'js/three.min.js', [], "panorama_viewer");
        $al->register('javascript', 'panorama-viewer', 'js/panorama-viewer.js', [], "panorama_viewer");

    }
    private function registerRoutes()
    {
        $this->router->loadRouteList(new RouteList());
    }
}