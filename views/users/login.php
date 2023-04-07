<div class="container">
    <h1>Login</h1>

    <form action="<?= ROOT_PATH ?>/authenticate" method="post">
        <div class="form-group my-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $form_fields["email"] ?? null ?>">
        </div>

        <div class="form-group my-3">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div>
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
</div>