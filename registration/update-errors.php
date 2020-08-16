<?php if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php endif ?>

<?php if (count($messages) > 0) : ?>
  <div class="text-success text-center">
  	<?php foreach ($messages as $message) : ?>
  	  <p><?php echo $message ?></p>
  	<?php endforeach ?>
  </div>
<?php endif ?>