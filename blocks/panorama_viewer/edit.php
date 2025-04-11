<?php

use Concrete\Core\Application\Service\FileManager;
use Concrete\Core\Form\Service\Form;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\View\View;

defined("C5_EXECUTE") or die("Access Denied.");

/** @var int $fID */

$fID = $fID ?? null;

$app = Application::getFacadeApplication();
/** @var FileManager $fileManager */
/** @noinspection PhpUnhandledExceptionInspection */
$fileManager = $app->make(FileManager::class);
/** @var Form $form */
/** @noinspection PhpUnhandledExceptionInspection */
$form = $app->make(Form::class);

/** @noinspection PhpUnhandledExceptionInspection */
View::element("dashboard/help_blocktypes", [], "panorama_viewer");

?>

<div class="form-group">
    <?php echo $form->label("fID", t("File")); ?>
    <?php echo $fileManager->file("fID", "fID", t("Please select..."), $fID); ?>
</div>
