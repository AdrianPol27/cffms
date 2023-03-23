<?php if (count($invalid) > 0) : ?>
  <div class="alert alert-danger error" role="alert">
  	<?php foreach ($invalid as $invalid) : ?>
			<ul class="m-0">
				<li><p class="m-0"><?php echo $invalid ?></p></li>
			</ul>
  	<?php endforeach ?>
  </div>
<?php endif ?>

<?php if (count($success) > 0) : ?>
  <div class="alert alert-success error" role="alert">
  	<?php foreach ($success as $success) : ?>
			<ul class="m-0">
				<li><p class="m-0"><?php echo $success ?></p></li>
			</ul>
  	<?php endforeach ?>
  </div>
<?php endif ?>

<?php if (count($info) > 0) : ?>
  <div class="alert alert-info error" role="alert">
  	<?php foreach ($info as $info) : ?>
			<ul class="m-0">
				<li><p class="m-0"><?php echo $info ?></p></li>
			</ul>
  	<?php endforeach ?>
  </div>
<?php endif ?>

