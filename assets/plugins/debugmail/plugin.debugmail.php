<?php
switch ($modx->event->name) {
    case 'OnWebPageInit':
    case 'OnPageNotFound':
    case 'OnManagerPageInit':
        include_once (MODX_BASE_PATH . 'assets/plugins/debugmail/debugmail.class.php');
        new Pathologic\Debugmail\Plugin($modx);
        break;
}
