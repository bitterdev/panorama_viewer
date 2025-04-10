<?php


defined('C5_EXECUTE') or die("Access Denied.");

if (Page::getCurrentPage()->isEditMode()) {
    print sprintf(
        "<div class=\"well\">%s</div>",
        t("Panorama Viewer is disabled in edit mode.")
    );
} else {
    print sprintf(
        "<div class=\"panorama-viewer\" data-panorama-picture=\"%s\" data-alternative-message=\"%s\">&nbsp;</div>",
        $selectedFile,
        t("The panorama image cant be displayed because youre Browser doesnt supports WebGL.")
    );
}