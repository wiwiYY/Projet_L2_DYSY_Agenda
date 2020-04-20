<!-- Lien police -->
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Hind+Guntur" rel="stylesheet">

<footer class="footer">
	<div class="row">
		<div class="contenufooter">
			<div id="firstcontainer" class="headingblock">
				<!-- Soit router link ou <a href> -->
				<a class="lin" href="#">Notre Entreprise</a>
				<a class="lin" href="#">Localisation</a>
				<a class="lin" href="#">Produit</a>
			</div>
				<!-- Footer -->
			<div class="socialblock">
				<div class="sociallist">
					<a href="https://fr-fr.facebook.com/">
					<img src="../../assets/fb_logo.png" alt="facebook" width="50px" height="50px"> 
					</a>
					<a href="https://twitter.com/?lang=fr">
						<img src="../../assets/twitter_logo.png" alt="twitter" width="50px" height="50px"> 
					</a>                            
					<a href="https://www.instagram.com/?hl=fr">
						<img src="../../assets/insta_logo.png" alt="instagram" width="50px" height="50px"> 
					</a>
					<a href="https://www.wechat.com/en/">
						<img src="../../assets/wechat_logo.png" alt="wechat" width="50px" height="50px"> 
					</a>	
				</div>
			</div>
			<div id="lastcontainer" class="headingblock">
				<p>© 2019 DYSY Inc. </p>
			</div>
		</div>
	</div>
</footer>

<style>
	/*Footer css */
.lin:link { 
	text-decoration:none; 
	font-family: 'Hind Guntur', sans-serif;
	font-size: 20px;
} 
.footer {
	position: relative;
	bottom: 0px;
	left: 0px;
    width: 100%;
    min-width: 720px;/*taille minimum, attention non compatible avec @media sceen*/
    background-color: #252525;
    height: 340px;
    color: white;
    padding-top: 4.35238095em;
    padding-bottom: 2.85238095em;
    text-align: center;
    font-size: 1.2em;
}
.headingblock {
    padding-bottom: 50px;
    margin-top: 16px;
    margin-bottom: 16px;
    font-family: 'Hind Guntur', sans-serif;
    color: grey;
}
.headingblock a{
    padding : 0px 15px 0px 15px;
}
.sociallist {
    padding-bottom: 13px;
}
.sociallist a {
    padding: 0px 95px 0px 95px;
}
#lastcontainer {
    justify-content: center;
	display: flex;
	background-color : #252525;
}
.lin {
    color: white;
}
.lin:visited, .lin:hover, .lin:focus, .lin:active {
    color: white;
}
</style>