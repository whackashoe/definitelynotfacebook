<?php foreach($results->errors as $e) { ?>
    <p class="error"><?=$e?></p><a href="/">Go Back</a>
<?php } ?>

<?php if(count($results->messages) > 0) { ?>
    <table class="pure-table">
        <thead>
            <tr>
                <th>Sender's Public Key</th>
                <th>Message</th>
            <th>Plain Message</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($results->messages as $message) { ?>
            <tr>
                <td><pre><?=htmlspecialchars($message->public_key)?></pre></td>
                <td><pre><?=htmlspecialchars($message->message)?></pre></td>
                <td><a href="/view?id=<?=$message->id?>">View Message Plaintext</a>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php if(count($results->messages) == 0) { ?>
    No messages hombre
<?php } ?>
