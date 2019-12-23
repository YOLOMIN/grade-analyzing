<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>login</title>
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="css/component.css" />
<!--[if IE]>
<script src="javaScript/html5.js"></script>
<![endif]-->
</head>
<body>
		<div class="container demo-1">
			<div class="content">
				<div id="large-header" class="large-header">
					<canvas id="demo-canvas"></canvas>
					<div class="logo_box">
						<h3>欢迎你</h3>
						<form action="login/login.php"  method="post">
							<div class="input_outer">
								<span class="u_user"></span>

								<input name="user" class="text" style="color: #FFFFFF !important" type="text" value="" placeholder="请输入学号">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="pwd" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;" value="" type="password" placeholder="请输入密码">
							</div>

							<div class="mb2">

							<input class="act-but submit" style="color: #FFFFFF;width: 334px;" type="submit" value="登录">

							</div>
                            <p align="right">还没有账号？<a href="register/register.php" target="_blank" style="color:#0056b3;" >立即注册</a></p>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /container -->
		<script src="javaScript/TweenLite.min.js"></script>
		<script src="javaScript/EasePack.min.js"></script>
		<script src="javaScript/rAF.js"></script>
		<script src="javaScript/demo-1.js"></script>


</body>
</html>