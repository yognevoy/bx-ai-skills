<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\UI\Extension;

Extension::load(['ui.notification']);

$component = $this->getComponent();
?>

<div id="vendor-example-container">

</div>

<script>
    BX.ready(function () {
        let componentParams = {
            signedParameters: '<?= $component->getSignedParameters() ?>',
        };
        BX.Vendor.Example.init(componentParams);
    });
</script>
