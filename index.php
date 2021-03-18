<?php

include('config.php');

$login_button = '';

if(isset($_GET["code"])){
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 if(!isset($token['error'])){
  $google_client->setAccessToken($token['access_token']);
  $_SESSION['access_token'] = $token['access_token'];
  $google_service = new Google_Service_Oauth2($google_client);
  $data = $google_service->userinfo->get();
  if(!empty($data['given_name'])){
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name'])){
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email'])){
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender'])){
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture'])){
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

if(!isset($_SESSION['access_token'])){
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="google.png" /></a>';
}

?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Praktikum PWL 1</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
 </head>
 <body>
 <div class="container">
 <h2>Login - Praktikum PWL 1</h2>
	<br/>
	<!-- cek pesan notifikasi -->
	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			echo "Login gagal! username dan password salah!";
		}else if($_GET['pesan'] == "logout"){
			echo "Anda telah berhasil logout";
		}
	}
	?>
	<br/>
	<br/>
	<form method="post" action="home.php">
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><input type="text" name="username" placeholder="Masukkan username"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td><input type="password" name="password" placeholder="Masukkan password"></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" value="LOGIN"></td>
			</tr>
		</table>			
	</form>
   <br />
   <h2>Login Melalui Akun Google</h2>
   <br />
   <div class="panel panel-default">
   <?php
   if($login_button == ''){
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }else{
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>
 </body>
</html>