<?php

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Entity\File\Version;
use Concrete\Core\File\File;
use Concrete\Core\Page\Page;

/** @var int $fID */
$f = File::getByID($fID);

$imageUrl = null;

if ($f instanceof \Concrete\Core\Entity\File\File) {
    $fv = $f->getApprovedVersion();

    if ($fv instanceof Version) {
        $imageUrl = $fv->getURL();
    }
}

?>

<?php if (Page::getCurrentPage()->isEditMode()) { ?>
    <p>
        <?php echo t("Panorama Viewer is disabled in edit mode."); ?>
    </p>
<?php } else { ?>
    <div class="panorama-viewer" data-panorama-picture="<?php echo $imageUrl; ?>"
         data-alternative-message="<?php echo h(t("The panorama image can't be displayed because your browser doesn't support WebGL.")); ?>"></div>
<?php } ?>