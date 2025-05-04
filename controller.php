<?php

namespace Concrete\Package\PanoramaViewer;

use Bitter\PanoramaViewer\Provider\ServiceProvider;
use Concrete\Core\Entity\Package as PackageEntity;
use Concrete\Core\Package\Package;

class Controller extends Package
{
    protected string $pkgHandle = 'panorama_viewer';
    protected string $pkgVersion = '0.0.2';
    protected $appVersionRequired = '9.0.0';
    protected $pkgAutoloaderRegistries = [
        'src/Bitter/PanoramaViewer' => 'Bitter\PanoramaViewer',
    ];

    public function getPackageDescription(): string
    {
        return t('Display 360-degree panoramic images with interactive navigation using a 3D viewer.');
    }

    public function getPackageName(): string
    {
        return t('Panorama Viewer');
    }

    public function on_start()
    {
        /** @var ServiceProvider $serviceProvider */
        /** @noinspection PhpUnhandledExceptionInspection */
        $serviceProvider = $this->app->make(ServiceProvider::class);
        $serviceProvider->register();
    }

    public function install(): PackageEntity
    {
        $pkg = parent::install();
        $this->installContentFile("data.xml");
        return $pkg;
    }

    public function upgrade()
    {
        parent::upgrade();
        $this->installContentFile("data.xml");
    }
}