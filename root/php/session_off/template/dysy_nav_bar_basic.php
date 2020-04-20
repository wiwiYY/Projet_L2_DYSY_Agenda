<!-- Lien police -->
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Hind+Guntur" rel="stylesheet">

<!-- Navigation bar pour session non ouvert -->
<header class="containerfluid header">
	<div class="container">
    	<a href="dysyPage.php" class="logo">DYSY Agenda</a>

    	<nav class="menu">
    		<a href="dysy_LogIn.php">Se Connecter</a>
    		<a href="dysy_SignIn.php">S'Inscrire</a>
    		<a href="dysyContactezNous.php">Contact</a>
    	</nav>
	</div>
</header>


<style>
body, html {
	padding:  0;
	margin: 0;

}
.containerfluid {
	padding: 0;
}
/*header*/
.header {
    background-color: #2C2C30;
	height: 70px;
	line-height: 70px;
}
/*logo*/

.logo{
	color: #ffffff;
	font-family: 'Gloria Hallelujah', cursive;
	font-size: 20px;
	
	font-weight: bold;
	letter-spacing: 1px;
	/* float: left; */
    margin-left: 20px;
    text-decoration: none;
}
/*menu*/

.menu {
	float: right;
	padding-right: 20px;
	font-family: 'Hind Guntur', sans-serif;
	font-size: 20px;
}

.menu a {
	color: #ffffff;
	margin-right: 20px;
	text-decoration: none;
}

.menu a:hover {
    background-color: rgb(44, 44, 58);
    border-radius: 15px;
    border: 0px none rgb(44, 44, 48);
	padding: 15px 0px 15px 0px;
	text-decoration: none;
}

</style>