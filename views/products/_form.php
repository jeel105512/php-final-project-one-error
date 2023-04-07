<?php
    // Convert product object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($product)) $form_fields = (array) $product;
?>

<?php if($carts && count($carts) > 0): ?>
<form action="<?= ROOT_PATH ?>/products/<?= $action ?>" method="post">
    <?php if ($action === "update"): ?>
        <input type="hidden" name="id" value="<?= $form_fields["id"] ?>">
    <?php endif ?>

    <div class="form-group my-3">
        <label for="product_name">Product Name</label>
        <input class="form-control" type="text" name="product_name" value="<?= $form_fields["product_name"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="price">Price</label>
        <input class="form-control" type="text" name="price" value="<?= $form_fields["price"] ?? "" ?>">
    </div>
    
    <div class="form-group my-3">
        <label for="description">Description</label>
        <input class="form-control" type="text" name="description" value="<?= $form_fields["description"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <select name="cart_id" class="form-select">
            <label for="cart_id">Cart</label>
            <option value="" selected>Choose a cart...</option>
            <?php foreach($carts as $cart): ?>
                <?php
                    $selected = (isset($form_fields["cart_id"]) && $form_fields["cart_id"] == $cart->cart_id) ? "selected" : "";    
                ?>
                <option value="<?= $cart->id ?>" <?= $selected ?>>
                    <?= $cart->cart_name ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>
<?php else: ?>
    <p class="alert alert-warning">
        You need to add a cart first. <br>
        <a href="<?= ROOT_PATH ?>/carts/new">New Cart</a>
    </p>
<?php endif ?>