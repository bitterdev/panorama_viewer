<?php


namespace Concrete\Package\PanoramaViewer\Block\PanoramaViewer;

use Concrete\Core\Block\BlockController;
use File;

class Controller extends BlockController {
    protected $btExportFileColumns = array(
        'fID'
    );

    protected $btTable = 'btPanoramaViewer';
    protected $btDefaultSet = "multimedia";
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputLifetime = 300;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;

    public function getBlockTypeDescription() {
        return t("Panorama Viewer Block Element.");
    }

    public function getBlockTypeName() {
        return t("Panorama Viewer");
    }

    private function getSelectedFile() {
        if ($this->fID > 0) {
            $fileObject = File::getById($this->fID);

            return $fileObject->getRelativePath();
        }

        return false;
    }

    public function view() {
        $this->requireAsset("javascript", "jquery");
        $this->requireAsset("javascript", "threejs");
        $this->requireAsset("javascript", "panorama-viewer");

        $this->set("selectedFile", $this->getSelectedFile());
    }
}
