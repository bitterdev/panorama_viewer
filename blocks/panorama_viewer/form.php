<?php

defined("C5_EXECUTE") or die("Access Denied.");

View::element("dashboard/help_blocktypes", [], "panorama_viewer");
?>

<div class="form-group">
    <?php
    $assets = Core::make('helper/concrete/asset_library');

    $fID = $controller->fID;

    $bf = null;

    if (!is_null($fID)) {
        $bf = File::getById($fID);
    }

    echo $assets->file('ccm-b-file', 'fID', t("Panorama image"), $bf);

    ?>
</div>
