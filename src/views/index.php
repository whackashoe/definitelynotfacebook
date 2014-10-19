<h2>Read Messages</h2>
<div class="pure-g">
	<div class="pure-u-1-2">
		<form action="/read" method="post" class="pure-form">
			<fieldset>
				<textarea name="your_key" rows="10" cols="30" placeholder="enter your public key"></textarea>
                <br>
                <button type="submit" name="submit" class="uibutton confirm large">read messages</button>
			</fieldset>
		</form>
	</div>
	<div class="pure-u-1-2">
		<h3>How this works:</h3>
		<p>
			You first need to generate a pgp keypair.
			If you do not know what this is or how to do this, please read <a href="/guide">this guide</a> and refrain from using this service until you understand.
			All messages are public and remain that way. You MUST use encryption. You MUST use <code>-armor</code>.
			For extra security send a new public key with your message for your recipient to respond with.
            <br>
            All messages are public. Make sure they are encrypted.
		</p>
	</div>
</div>

<br>
<hr>
<br>

<h2>Send Message</h2>
<form action="/send" method="post" class="pure-form">
	<fieldset>
		<textarea name="send_key" rows="10" cols="30" placeholder="enter your public key (optional, leave blank if you don't want)"></textarea>
		<textarea name="receive_key" rows="10" cols="30" placeholder="enter your recipients public key"></textarea>
		<textarea name="message" rows="10" cols="30" placeholder="enter your ENCRYPTED message, max size is 64k" maxlength="65535"></textarea>
        <br>
		<button type="submit" name="submit" class="uibutton confirm large">send message</button>
	</fieldset>
</form>
