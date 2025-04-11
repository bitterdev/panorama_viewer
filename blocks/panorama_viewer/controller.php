<?php


namespace Concrete\Package\PanoramaViewer\Block\PanoramaViewer;

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btExportFileColumns = [
        'fID'
    ];
    protected $btTable = 'btPanoramaViewer';
    protected $btDefaultSet = "multimedia";
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputLifetime = 300;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;

    public function getBlockTypeDescription(): string
    {
        return t("Panorama Viewer Block Element.");
    }

    public function getBlockTypeName(): string
    {
        return t("Panorama Viewer");
    }

    public function registerViewAssets($outputContent = '')
    {
        parent::registerViewAssets($outputContent);

        $this->requireAsset("javascript", "jquery");
        $this->requireAsset("javascript", "threejs");
        $this->requireAsset("javascript", "panorama-viewer");
    }
}
