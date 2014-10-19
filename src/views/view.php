<?php foreach($results->errors as $e) { ?>
    <p class="error"><?=$e?></p>
    <a href="index.php">Go Back</a>
<?php } ?>

<?php if(count($results->errors) == 0) { ?>
	<?=$results->message?>
<?php } ?>
