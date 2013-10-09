<?php
require_once("includes.php");
?>
<?=$pagetop?>


<h2>Read Messages</h2>
<div class="pure-g">
	<div class="pure-u-1-2">
		<form action="readmessages.php" method="post" class="pure-form">
			<fieldset>
				<textarea name="your_key" rows="10" cols="30" placeholder="enter your public key"></textarea>
				<input type="submit" name="submit" value="read messages" class="pure-button pure-button-primary">
			</fieldset>
		</form>
	</div>
	<div class="pure-u-1-2">
		<h3>How this works:</h3>
		<p>
			You first need to generate a pgp keypair.
			If you do not know what this is or how to do this, please read <a href="guide.html">this guide</a> and refrain from using this service until you understand.
			All messages are public and remain that way. You MUST use encryption. You MUST use <code>-armor</code>.
			For extra security send a new public key with your message for your recipient to respond with.
			<br><br>
			In exchange for funding, you will continue the fight for freedom.
			<br><strong>Bitcoin:</strong> <i>1Ar4q49gdRLwntzFURngRVd8BhzAdccQFT</i>
		</p>
	</div>
</div>

<br>
<hr>
<br>

<h2>Send Message</h2>
<form action="sendmessage.php" method="post" class="pure-form">
	<fieldset>
		<textarea name="send_key" rows="10" cols="30" placeholder="enter your public key"></textarea>
		<textarea name="receive_key" rows="10" cols="30" placeholder="enter your recipients public key"></textarea>
		<textarea name="message" rows="10" cols="30" placeholder="enter your ENCRYPTED message"></textarea>
		<input type="submit" name="submit" value="send message" class="pure-button pure-button-primary">
	</fieldset>
</form>
<?=$pagebottom?>
