	<div class="modal-layer">
			<div id="AddNews" class="window"><div class="header">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Új hír szerkesztése</b><div class="close" onclick="core.closeModalWindow('#AddNews');">&times;</div></div> 
				<div class="content">
					<br>Ki láthatja: <select name="cat"><option value='0'>Nyilvános</option><option value='1'>Bejelentkezet</option><option value='2'>Tag</option><option value='3'>Moderátor</option></select><br>
					<br>Cím: <input type="text" name="Newstit" maxlength="50"><br>
					<br>Szöveg: <br><textarea name="txt" id="txt" onKeyUp="alert(this.value);counttext();"></textarea><br><br>
					<span class="button"> Ment </span>&nbsp;&nbsp;<span class="button" onclick="core.closeModalWindow('#AddNews');"> Mégse </span>
				</div>
			</div>
		</div>
		
		<div class="header-line">
			<div class="burger">
				<input type="checkbox" />
				<span class="burger-line"></span>
				<span class="burger-line"></span>
				<span class="burger-line"></span>
				<span class="burger-line"></span>
				<span id="burger_menu">
					<nav>
						<?= implode('',View::$menuLinks['ALL']) ?>
					</nav>
					<span class="log-related">
						<?= implode('',View::$menuLinks[Controller::isUserLogged() ? 'USER_ONLY' : 'GUEST_ONLY']) ?>
					</span>
				</span>					
			</div>		
		</div>		
		<div class="grid">
			<header>
				<div class="shadow"></div>
				<div class="log-menu">
					<?= implode('',View::$menuLinks[Controller::isUserLogged() ? 'USER_ONLY' : 'GUEST_ONLY']) ?>
				</div>
				<picture>
				  <div class="igevers"> </div>				  
				</picture>			
			</header>
			<nav>
				<div class="menu">
					<?= implode('',View::$menuLinks['ALL']) ?>
				</div>
			</nav>
			<main>
				<div class="content">
					<!-- linkekt s functionket ki kell majdjvitani -->
					<div class="header">
						<h1> </h1><br><br>
						<div class="media">
							<div class="coverFrame"><div class="coverPicture"></div>
							</div>
							<div class="stickyNote">
								<h2><?= $T['Last_Event']->title ?></h2>
								<span class='message'>
									<p><?= $T['Last_Event']->message ?></p>
								</span>
								<a href='/naptar' title='Összes eseménz megmutatása'><div class="more button col-gray">Előzmények</div></a>
							</div>								
						</div>
					</div>	
					<br>
					<h2>Rólunk:</h2> Gyülekezetünk 15 éve jött létre és 7 helységben vannak gyülekezeteink: <a id='NagyvaradBox' onclick=alert('Jobb&nbsp;oldalon&nbsp;látható');>Nagyvárad</a>, <a href='javascript:void(0);' onclick='ShowMissionInfo(1);'>Szalonta</a>, <a href='javascript:void(0);' onclick='ShowMissionInfo(2);'>Székelyhíd</a>, Mónospetri, Bogyoszló, <a href='javascript:void(0);' onclick='ShowMissionInfo(5);'>Margitta</a>, <a href='javascript:void(0);' onclick='ShowMissionInfo(6);'>Érmihályfalva.</a><br><br>
					<h2>Hitünk:</h2> Hiszünk az egy igaz Istenben, Jézus Krisztusban mint Isten fiában aki a mi megváltónk, a Szent Szellemben mint vígasztaló és tanító, a Bibliában mint Isten igéjeben ami Istentől ihletett útmutatónk. Részletes hitvallás <a href='OurFaith.php'> ezen a linken </a> tekinthető meg.<br><br>
					<h2>Vallás:</h2> Jézus nem vallást teremtett hanem keresztény életformát, ez egy helyreállításról szól Isten és emberközt, nem ember által alkotott tradiciókra épül hanem egy élő kapcsolatra.<br>Isten nem egy vallás, nem egy felekezet hanem egy személyes kapcsolat...<br><br>
					<h2>Célunk:</h2> Célunk, hogy emberek megtérjenek, megtapasztálják a Isten szeretetét, áldásait amit Jézus Krisztusban kijelentett az egész világ számára....<br><br>
				</div>
			</main>
			<aside> 
				<div class="fund">
					Ha szeretnéd támogatni anyagilag a gyülekezetet vagy missziókat:
					<br><br><h3>Bank adress:</h3> BANCPOST S.A. str. Tudor Vladimirescu nr. 1
					<br><i><b>ASOCIATIA CENTRUL CRESTIN BIRUINTA</b></i> str. Dunarea nr.13 ORADEA RO
					<br><br><h3>Bank account number:</h3> RO38BPOS05003108254ROL01
					<br><br><span class="red"><b>Swift code:</b></span> BPosRoBu
				</div>
				<!--  AIzaSyB1pP2qSduLROFkGTYjKVNsLfhQWLdDQig -->
				<div class="social">
				<div class="relative">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2717.9150322347678!2d21.932089015611613!3d47.06151707915227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x474647e056cf23f9%3A0x9a1c1b519cdc1b5b!2sStrada+Dun%C4%83rea+13%2C+Oradea!5e0!3m2!1sen!2sro!4v1513228486726" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<!--
					<br><h3>Kövehetnek minket a következő oldalakon</h3>
					<br>
					<a href="" title="Facebookos oldal"><img src="./img/icons/social/facebook.png" alt="fb"></a> 
					<a href="" title="Youtube csatorna"><img src="./img/icons/social/youtube.png" alt="yt"></a>
				-->
				</div>				
				<div class="service">
					<h2>Alkalmaink:</h2><br>
					<b>Istentisztelet:</b> <span class="main-service">Vasárnap 16:00</span><br>
					<b>Imaalkalom:</b> <span class="pray-service">Csütörtök 19:00</span><br>
					<b>Imaéjszaka:</b> <span class="night-service">Minden hó utolsó szombata 19:00</span><br><br>
					<b>Címünk:</b> <p>Románia, Nagyvárad/Oradea, Dunarea utca, 13-as szám.<br>
					<a href='http://maps.google.ro/maps?hl=ro&client=firefox-a&hs=jOB&rls=org.mozilla:en-GB:official&q=oradea%20dunarii%2013&um=1&ie=UTF-8&sa=N&tab=wl'> google map </a> - 
					<a href='http://maps.google.ro/maps?f=q&source=s_q&hl=ro&geocode=&q=oradea+dunarii+13&aq=&sll=47.061791,21.934934&sspn=0.007177,0.013797&g=oradea+dunarea+13&ie=UTF8&hq=&hnear=Strada+Dun%C4%83rea,+Oradea&ll=47.061674,21.933931&spn=0.001794,0.003449&z=18&layer=c&cbll=47.061709,21.933823&panoid=PxLWmzGtTo3-Es2FfLygjg&cbp=12,19.47,,0,23.9'>google map 2</a>
					</p><br>
					<b>Email cím:</b> office@gyozelem.ro 
				</div>
			</aside>
			<footer>
				&copy; 2017 by Varga Zsolt
			</footer>
<!--
<address></address>
<details>
  <summary>Copyright 1999-2014.</summary>
  <p> - by Refsnes Data. All Rights Reserved.</p>
  <p>All content and graphics on this web site are the property of the company Refsnes Data.</p>
</details>

<picture>
  <source media="(min-width: 650px)" srcset="img_pink_flowers.jpg">
  <source media="(min-width: 465px)" srcset="img_white_flower.jpg">
  <img src="img_orange_flowers.jpg" alt="Flowers" style="width:auto;">
</picture>
-->			
		</div>