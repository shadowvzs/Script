<div class="fakeModal"></div>
<section>
	<div class="form">
		<h1>Bejelentkezés</h1>
		<form action="/bejelentkezes" method="POST" id="<?= $T['FORM']?>">
		 	<!-- insert the precreated input fields, according our array -->
			<?= implode('',$T['PHP_INPUT']) ?>
			<div id="errorBox" class="errorBox"><?= html_entity_decode($T["error"]); ?>	</div> 
			<a href="javascript:void(0);" title="Bejelentkezés" onclick="return Input_Validator.submitForm('<?= $T['FORM']?>');"><button class="button col-gray"> Bejelentkezés </button></a>
		</form>
		<a href='/regisztracio' title="Új fiók regisztrálása"><button class="button col-gray"> Regisztrálás </button></a>
		<br><br>
		<a href="#" class="disabled underlined">Elfelejtette a jelszavat?</a>
	</div>
</section>
