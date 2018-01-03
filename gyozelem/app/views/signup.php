<div class="fakeModal"></div>
<section>
	<div class="form">
		<h1>Regisztrálás</h1>
		<form action="/regisztracio" method="POST" id="<?= $T['FORM']?>"> 
		 	<!-- insert the precreated input fields, according our array -->
			<?= implode('',$T['PHP_INPUT']) ?>
			<div id='errorBox' class='errorBox'><?= html_entity_decode($T["error"]); ?>	</div> 
			<a href='javascript:void(0)' title="Fiók elkeszítése" onclick="return Input_Validator.submitForm('<?= $T['FORM']?>');"><button class="button col-gray reg"> Rendben</button></a>
		</form>
		
		<a href="/bejelentkezes" title="Jelentkezen be ha van már fiókja">Már van egy fiókja? Jelentkezen be</a>
	</div>
</section>
