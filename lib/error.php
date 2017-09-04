<?php if (count($error) > 0): ?>
    <div class="errors">
        <?php foreach ($errors as $error); ?>
            <p><?php echo $errors; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
