
<?php

session_start();
include('config/config.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DATABASE);

if (isset($_SESSION['user'])){
        header('Location: dboard/index.php');
    }


if(isset($_POST['submit'])){
	if(!$connection){
		die("connection fail");
	}
	
	if (!$connection->set_charset("utf8")) {
		 printf("Error loading character set utf8: %s\n",$connection->error);
	} 
	
	$query = "SELECT * FROM admin"; 
	$result = mysqli_query($connection, $query);
		
	if(!$result){
		die('QUERY FAILED' . mysqli_error());
	}
	
	if(isset($_POST['password']))
		$pass = $_POST['password'];
	if(isset($_POST['username'])) 
		$user = $_POST['username'];
	//echo $pass . $user;
		
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
		if ($user == $row['username'] and $pass == $row['password']){
			$_SESSION['user']= $user;
			header('Location: us/index.php');
		}
		//else
			//header('Location: index.php');
	endwhile;
}

if(isset($_GET['logout'])){
	session_destroy();
	header('Location: index.php');
}
//
?>
<!DOCTYPE html>
<!-- Referente ao index-login  do dboard catraca-->
<html lang="pt_BR">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="base/images/Iconka-Pool-Pool-bird.ico">
		<title>Admin login</title>
		<!-- Bootstrap core CSS -->
		<link href="base/css/bootstrap.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="base/css/signin.css" rel="stylesheet">
	</head>

	<body>
		<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
        
            <div class="container">               
				<div class="row vertical-offset-80">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
							<div class="panel-heading">                        
                                <!--<div class="centered">-->
								<div class="row-fluid user-row">
									<div> 
                                    	<img src="http://www.google.com.br/google.jpg" align="center" class="img-responsive" alt="Conxole Admin"/>
                                    </div>
                                </div>
							</div>
								<form class="form-signin" action="index.php" method="POST">
									<h1 class="form-signin-heading"><small>Logar no Sistema</small></h1>							
								<form class="form-inline">
								<div class="form-group">
									<label class="sr-only" for="exampleInputAmount"></label>
										<div class="input-group">
											<div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
												<input type="text" name="username" class="form-control" id="exampleInputAmount" placeholder="Digite usuário">										
										</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock" aria-hidden="true"></span></div>
										<input type="password" name="password" class="form-control" id="exampleInputAmount" placeholder="Digite a senha">
									</div>
								</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"> Lembrar a Senha
									
								</label>
							</div>
							<button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Clque e Entre</button>	  
						</form>
                        </div>
                    </div>
                </div>
            </div>
        </body>
      </div>
  </body>  
</html>

	
						
					