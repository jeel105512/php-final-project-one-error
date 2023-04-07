<?php
    // Convert resource object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
?>

<form action="<?= ROOT_PATH ?>/users/create" method="post">
    <div class="form-group my-3">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="<?= $form_fields["name"] ?? null ?>">
    </div>

    <div class="form-group my-3">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="<?= $form_fields["email"] ?? null ?>">
    </div>

    <div class="form-group my-3">
        <label for="email_confirmation">Email Confirmation</label>
        <input type="email" name="email_confirmation" class="form-control" value="<?= $form_fields["email_confirmation"] ?? null ?>">
    </div>

    <div class="form-group my-3">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group my-3">
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>