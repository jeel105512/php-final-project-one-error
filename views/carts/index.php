<div>
    <h1>List Carts</h1>

    <?php if (isset($carts) && count($carts) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Cart Name</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($carts as $cart): ?>
                <tr>
                    <td><?= $cart->cart_name ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/carts/edit/<?= $cart->id ?>">edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/carts/delete/<?= $cart->id ?>" onclick="return confirm('Are you sure you want to delete this cart?')">delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>
</div>