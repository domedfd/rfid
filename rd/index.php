<!DOCTYPE html>

<?php 
include_once('../config/time.php');
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');
session_start();
if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');
include_once('../config/time.php'); 	
include('../functions/functions.php'); 
?>
<?php

	if(isset($_GET['menu_id']))
		$menu_id = $_GET['menu_id'];
    if(isset($_GET['action_id']))
		$action_id = $_GET['action_id'];
?>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>painel de instrumentos</title>
    <!-- Bootstrap -->
    <link rel="icon" href="../base/images/Iconka-Pool-Pool-bird.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../base/css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../base/css/simple-sidebar.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
   
         <div id="sidebar-wrapper"> <!-- rfe se ao menu-->
            <?php include('../views/slider.php'); ?> <!-- rfe se a barra lateral-->
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <?php include('../views/nav_menu.php'); ?>
                <!--<div class="padding-top-20"></div>-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                <a href="#menu-toggle" class="btn btn-default btn-sm pull-left menu-button" id="menu-toggle"><span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span></a>
                            </div>
                            <div class="col-xs-8 col-sm-6 col-md-4 col-lg-3 pull-right">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Procurar por...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="padding-top-20"></div>
                        <!--<div class="row">-->
                        <!--    <div class="col-lg-12">-->
                        <!--        <div class="form-group pull-left">  -->
                        <!--            <button type="submit" class="btn btn-success btn-sm" name="submit" form="add_user">Save</button>-->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button">Cancel</a>-->
                        <!--            <a href="#" class="btn btn-primary btn-sm" role="button">Add user</a>    -->
                        <!--        </div>-->
                        <!--        -->
                        <!--        <div class="btn-group pull-right">-->
                        <!--            <a href="?list=1" class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>-->
                        <!--            <a href="?box=1" class="btn btn-default btn-sm active" role="button"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></a>-->
                        <!--            <a href="?form=1&view=1" class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>-->
                        <!--        </div>-->
                        <!--        -->
                        <!--        -->
                        <!--        <div class="btn-group pull-right padding-right-10">-->
                        <!--            &nbsp;&nbsp;&nbsp;&nbsp;                      -->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>-->
                        <!--            <a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>-->
                        <!--        </div>    -->
                        <!--        <h5 class="pull-right padding-right-10">5/10</h5>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--Relacionaos ao painel de relatórios-->
                        <!--<hr class="line">-->                     
                        <div class="row">
                                    <div class="col-lg-12">
                                    <h2><small><span class="label label-success"><?php include_once('../config/time.php'); $data = date('H:i:s'); echo $data .= ' &nbsp'.'&nbsp '. date('d/m/Y'); ?> &nbsp <span class="label label-success"> Contadores de Cartões</span><small><span class="label label-success"></span></h2>
									 <div class="row padding-top-10">
									<div class="col-md-4">
										<a href="" class="thumbnail ">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp Cartões Ativos </h4><h3><span class="label label-success"><?php active_cards_count($connection); ?></span></h3>
												<h5></h5>
												</div>
											</div>
										</a>
									</div>
									<div class="col-md-4">
										<a href="" class="thumbnail">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp Cartões Bloqueados </h4><h3><span class="label label-danger"><?php block_cards_count($connection); ?></span></h3>
												<h5></h5>
												</div>
											</div>
										</a>
									</div>
									<div class="col-md-4">
										<a href="" class="thumbnail bg-red">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Cartões Novos</h4><h3><span class="label label-warning"><?php new_cards_count($connection); ?></span></h3>
												<h5></h5>
												</div>
											</div>
										</a>
									</div>
									<!--ref ao titulo-->
									<div class="col-lg-12">
									<h2><small><span class="label label-success"><?php include_once('../config/time.php');  $data = date('d-m-Y'); echo $data .= ' &nbsp'.'&nbsp '.date('H:i:s'); ?> &nbsp <span class="label label-success"> Contadores de Entradas</span><small><span class="label label-success"></span></h2>
									<div class="row padding-top-10">
									
									<div class="col-md-4">
										<a href="" class="thumbnail">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>&nbsp Entradas Normais </h4><h3><span class="label label-default"></span></h3>
												<h5></h5>
												</div>
											</div>
										</a>
									</div>
									<div class="col-md-4">
										<a href="" class="thumbnail">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-eur" aria-hidden="true"></span>&nbsp Saídas Normais </h4><h3><span class="label label-default"><?php $data = date('d-m-Y'); echo $data .= ' '.date('H:i:s'); ?></span></h4>
												<h4></h4>
												</div>
											</div>
										</a>
									</div>
									<div class="col-md-4">
										<a href="" class="thumbnail bg-test">
											<div class="row">
												<div class="col-sm-12">
												<h4><span class="glyphicon glyphicon-bed" aria-hidden="true"></span>&nbsp Entradas Bloqueadas </h4><h3><span class="label label-success"><?php $data = date('d-m-Y'); echo $data .= ' '.date(''); ?></span></h4>
												<h5></h5>
												</div>
											</div>
										</a>
									</div>
									<div class="col-md-6">
										<a href="../ea/?menu_id=2" class="thumbnail bg-red">
											<div class="row">
												<div class="col-sm-12">
													<h5><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Acesso Geral &nbsp&nbsp<span class="label label-warning"><?php echo $Entrou ?></span></h5>
												</div>
											</div>
										</a>
									</div>
                                    <div class="col-md-6">
                                        <a href="../ea/?menu_id=2" class="thumbnail bg-red">
                                                <div class="row">
                                                        <div class="col-sm-12">
                                                            <h5><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Acesso Geral &nbsp&nbsp<span class="label label-warning"><?php include_once('../config/time.php'); $data = date('d/m/Y'); echo $data .= ' '.date('H:i:s'); ?></span></h5>
                                                            <h5><div align="center">Controle de Entrada e saidas</div></h5>
                                                        </div>
                                                </div>
                                        </a>
                                    </div>
                                    								
								
                            	</div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../base/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../base/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
