<form method="POST" action="?q=get-name">
    <?php if (isset($errors)):?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <input type="text" name="first_name" placeholder="First name" value="<?php echo isset($errors) ? $firstName ?? '' : ''; ?>"/>
    <input type="text" name="last_name" placeholder="Last name" value="<?php echo isset($errors) ? $lastName ?? '' : ''; ?>" />
    <input type="submit" />
</form>