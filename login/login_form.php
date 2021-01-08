<? session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="../css/login.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/member2.css" rel="stylesheet" type="text/css" media="all">
<style>
body div
{cursor: url('../img/enterprise.ani'), url('../img/cursor.png'), auto;}
</style>
</head>

<body>
<div id="wrap">
  <div id="header">
    <? include "../lib/top_login2.php"; ?>
  </div>  <!-- end of header -->

  <div id="menu">
	<? include "../lib/top_menu2.php"; ?>
  </div>  <!-- end of menu --> 

  <div id="content">


	<div id="col2">
        <form  name="member_form" method="post" action="login.php"> 
		<div id="title">
			<img src="../img/title_login.png">
		</div>
       
		<div id="login_form">
		    
			

		
			 <div id="login2">
				<div id="id_input_button">
					<div id="id_pw_title">
						<ul>
						<li><img src="../img/id_title.png"></li>
						<li><img src="../img/pass_title.png"></li>
						</ul>
					</div>
					<div id="id_pw_input">
						<ul>
						<li><input type="text" name="id" class="login_input"></li>
						<li><input type="password" name="pass" class="login_input"></li>
						</ul>						
					</div>
					<div id="login_button">
						<input type="image" src="../img/title_login.png">
					</div>
				</div>
				<div class="clear"></div>

				<div id="login_line"></div>
				<div id="join_button"><img src="../img/no_join.png">&nbsp;&nbsp;&nbsp;&nbsp;<a href="../member/member_form.php"><img src="../img/join_button2.png"></a></div>
			 </div>			 
		</div> <!-- end of form_login -->

	    </form>
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>