<?php foreach($results->errors as $e) { ?>
    <p class="error"><?=$e?></p>
<?php } ?>

<?php if(count($results->errors) > 0) { ?>
    <a href="/">Go Back</a>
<?php } ?>

<?php if(count($results->errors) == 0) { ?>
    Message sent. Confirm that <a href="/read?id=<?=$receive_id?>">here</a>
<?php } ?>
