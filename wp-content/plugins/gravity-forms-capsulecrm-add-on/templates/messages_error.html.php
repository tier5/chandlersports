<div id="message" class="error">
	<?php     if ($message=="gf_not_activated"):?>
	<p>Gravity Forms is installed but not active. <strong>Activate Gravity Forms</strong> to use the Gravity Forms CapsuleCRM plugin.</p>
	<?php elseif ($message=="gf_not_installed"):?>
	<h2><a href="http://katz.si/gravityforms">Gravity Forms</a> is required.</h2>
	<p>You do not have the Gravity Forms plugin enabled. <a href="http://katz.si/gravityforms">Get Gravity Forms</a>.</p>
	<?php elseif ($message=="name_problem"):?>
	<p>
		The entry was not added to CapsuleCRM because <strong>both first and last
		names are required</strong>, and were not detected. <em>You are only being
		shown this because you are an administrator. Other users will not see this
		message.<em>
	</p>
	<?php endif?>
</div>