<?php
    // Convert resource object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($resource)) $form_fields = (array) $resource;
?>

<form action="<?= ROOT_PATH ?>/resources/<?= $action ?>" method="post">
    
</form>