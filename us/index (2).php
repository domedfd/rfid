<!DOCTYPE html>
<?php
session_start();
include_once('../config/time.php');
include('../functions/functions.php');
if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

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
    <title>Todos Registros</title>
    <!-- Bootstrap -->
    <link rel="icon" href="../base/images/Iconka-Pool-Pool-bird.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../base/css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../base/css/simple-sidebar.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        
        <?php include('../views/slider.php'); ?>

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
                        <div class="row">
                           <div class="col-lg-12">
                               <div class="form-group pull-left"> 
                                   <!--<button type="submit" class="btn btn-success btn-sm" name="submit" form="add_user">Save</button>-->
                                   <!--<a href="#" class="btn btn-default btn-sm" role="button">Cancel</a>-->
                                   <?php echo '<a href="add_new_user.php?menu_id='. $menu_id . '&action_id='. $action_id .'&add=True" class="btn btn-primary btn-sm" role="button">Adicionar</a>';?>
                               </div>
      
								<div class="btn-group pull-right">
                                    <a href="?list=1" class="btn btn-default btn-sm active" role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                                   <!--<a href="?box=1" class="btn btn-default btn-sm active" role="button"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></a>-->
                                  <a href="?form=1&view=1" class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>
								</div>
    
                               <div class="btn-group pull-right padding-right-10">
                                    &nbsp;&nbsp;&nbsp;&nbsp;                     
                                    <a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
                                    <a href="#" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                               </div>   
                               <h5 class="pull-right padding-right-10">1/1</h5>
                         </div>
                        </div>
                        
                        <hr class="line">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <!--<h3><small>Registrados</small></h3><br>-->
                                <div class="table-responsive">
									<?php get_all_users($connection, $menu_id, $action_id);?>
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
	
	jQuery(document).ready(function($) {
		$(".clickable-row").click(function() {
			window.document.location = $(this).data("href");
		});
	});
    </script>

</body>

</html>
