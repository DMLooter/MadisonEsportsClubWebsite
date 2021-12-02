<div id="header">
	<div id="spacer"></div>
	<div id="img"><img width="100px" height="100px" src="Images/Logo.png" /></div>
	<div id="title"><h1>MADISON ESPORTS CLUB</h1></div>
	<?php
		if(isset($_SESSION["logged"]) && $_SESSION["logged"]){
			print("<div id='account_buttons'><div id='user' class='button'>".$_SESSION["user"]."</div><a href='logout' class='button_link'><div id='logout' class='button'>Logout</div></a></div>");
		}else{
			print("<div id='account_buttons'><a href='loginpage' class='button_link'><div id='login' class='button'>Login</div></a><a href='registration' class='button_link'><div id='register' class='button'>Register</div></a></div>");
		}
	?>
</div>

<div class="menu-wrap">
		<nav class="menu">
				<ul class="clearfix">
						<li id="home"><a href="index">HOME</a></li>
						<li id="calendar">
								<a href="calendar">CALENDAR</a>
								<!--<a href="games">Projects <span class="arrow">&#9660;</span>$

								<ul class="submenu">
										<li><a href="">Games</a></li>
										<li><a href="">Utilities</a></li>
								</ul>-->
						</li>
						<li id="createevent"><a href="createevent">ADD EVENT</a></li>
						<li id="info"><a href"info">CLUB INFO</a>
							<ul class="submenu">
								<li><a href="games">GAMES</a></li>
								<li><a href="board">BOARD</a></li>
								<li><a href="about">ABOUT THE CLUB</a></li>
							</ul>
						</li>
				</ul>
		</nav>
</div>
<script src="header.js" type="text/javascript"></script>

