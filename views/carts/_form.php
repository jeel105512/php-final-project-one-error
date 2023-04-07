<?php
    // Convert cart object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($cart)) $form_fields = (array) $cart;
?>

<form action="<?= ROOT_PATH ?>/carts/<?= $action ?>" method="post">
    <?php if ($action === "update"): ?>
        <input type="hidden" name="id" value="<?= $form_fields["id"] ?>">
    <?php endif ?>

    <div class="form-group my-3">
        <label for="cart_name">Cart Name</label>
        <input class="form-control" type="text" name="cart_name" value="<?= $form_fields["cart_name"] ?? "" ?>">
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>