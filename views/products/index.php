<div>
    <h1>List Products</h1>
    <section>
        <?php if (isset($products) && count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="name-price">
                        <div class="product-name"><?= $product->product_name ?></div>
                        <div class="product-price">$<?= $product->price ?></div>
                    </div>
                    <div class="product-description">
                        <div>Product Description:</div>
                        <div><?= $product->description ?></div>
                    </div>
                    <div class="cart-name">
                        <div>Cart:</div>
                        <div><?= $product->cart ?></div>
                    </div>
                    <div class="edit-delete">
                        <a href="<?= ROOT_PATH ?>/products/edit/<?= $product->id ?>">
                            <div class="edit-icon"><i class="fa-solid fa-pen"></i></div>
                            <div>Edit</div>
                        </a>
                        <a href="<?= ROOT_PATH ?>/products/delete/<?= $product->id ?>" onclick="return confirm('Are you sure you want to delete this product?')">
                            <div class="delete-icon"><i class="fa-solid fa-trash"></i></div>
                            <div>Delete</div>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </section>


</div>