<div id="header">
	<div id="spacer"></div>
	<div id="img"><img width="100px" height="100px" src="/Images/Logo.png" /></div>
	<div id="title"><h1>MADISON ESPORTS CLUB</h1></div>
	<?php
		if(isset($_SESSION["logged"]) && $_SESSION["logged"]){
			print("<div id='account_buttons'><div id='user' class='button'>".$_SESSION["user"]."</div><a href='/logout' class='button_link'><div id='logout' class='button'>Logout</div></a></div>");
		}else{
			print("<div id='account_buttons'><a href='/loginpage' class='button_link'><div id='login' class='button'>Login</div></a><a href='/registration' class='button_link'><div id='register' class='button'>Register</div></a></div>");
		}
	?>
</div>

<div class="menu-wrap">
		<nav class="menu">
				<ul class="clearfix">
						<li id="home"><a href="/index">HOME</a></li>
						<li id="calendar">
							<a href="/calendar">EVENTS</a>
						</li>
						<li id="streams"><a href="/streams">STREAMS</a></li>
						<li id="info"><a href"/info">CLUB INFO<span class="arrow">&#9660;</span></a>
							<ul class="submenu">
								<li><a href="/games">GAMES</a></li>
								<li><a href="/board">BOARD</a></li>
								<li><a href="/about">ABOUT THE CLUB</a></li>
								<li><a href="https://docs.google.com/document/d/1WzzOLA4ZDbHWsLK4B5hm7wOwsUFBaWv0nn2XoDEN_wY?usp=sharing">BYLAWS</a></li>
							</ul>
						</li>
				</ul>
		</nav>
</div>
<script src="/header.js" type="text/javascript"></script>

