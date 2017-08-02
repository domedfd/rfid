<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
else
	header('Location: ../index.php');

include_once('../functions/functions.php');
require_once("../db/db.php");
header("Content-type: text/html; charset=utf-8");

$menu_id = '';
$action_id = '';
$status = '';
$add = '';
$edit = '';
$date= date("d/m/Y");
$exists=False;
$employee_id = '';
$edited ='';
$name='';
$telephone = '';
$email = '';
$foto = '';


if(isset($_GET['menu_id'])){
    $menu_id = $_GET['menu_id'];
}

if(isset($_GET['action_id'])){
    $action_id = $_GET['action_id'];
}

if(isset($_GET['employee_id'])){
    $employee_id = $_GET['employee_id'];
}

if(isset($_GET['edit'])){
    $edit = $_GET['edit'];
}

if(isset($_GET['add'])){
	$add = $_GET['add'];
}

if(isset($_SESSION["edited"])){
	$edited = $_SESSION["edited"];
}

if(isset($_GET['employee_id'])){
	require_once("../db/db.php");
	$query = "SELECT * FROM employee WHERE id=" . $employee_id . " LIMIT 1;";
	$result = mysqli_query($connection, $query);
	$date = date("d/m/Y");
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
		$name = $row['name'];
		$date = $row['date'];
		$telephone = $row['telephone'];
		$email = $row['email'];
		$foto = $row['foto'];
	endwhile;
}


?>
<html lang="pt_br">
<meta charset="UTF-8">
<title>Exemplo Imput type = date.</title>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Adicionar Registros</title>
    <!-- Bootstrap -->
    <link rel="icon" href="../base/images/Iconka-Pool-Pool-bird.ico">
    <!-- Bootstrap Core CSS -->
    <link href="../base/css/bootstrap.css" rel="stylesheet">
    <link href="../base/css/bootstrap-select.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../base/css/simple-sidebar.css" rel="stylesheet">
	<link href="../base/css/bootstrap-datepicker.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?php include('../views/slider.php'); ?>
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
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <a href="#menu-toggle" class="btn btn-default btn-sm pull-left menu-button" id="menu-toggle"><span class="glyphicon glyphicon-resize-horizontal" aria-hidden="true"></span></a>
                            </div>
                        </div>
                        <div class="padding-top-20"></div>
                        <div class="row">
                            <div class="col-lg-12">
								<div class="form-group pull-left">  
                                    <!--<button type="submit" class="btn btn-warning btn-sm" name="submit" form="add_user">Edit</button>-->
                                    <?php
                                    if(isset($_GET['add']) || isset($_GET['edit'])){
										echo '<button type="submit" class="btn btn-success btn-sm" name="submit" form="save_employee">Salvar</button>';	
									}
                                    else{
										echo '<a href="?menu_id=' . $menu_id . '&action_id=' . $action_id . '&employee_id=' . $employee_id . '&edit=true" class="btn btn-warning btn-sm" role="button">Editar</a>';
										echo ' <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Deletar</button>';
										echo ' <a href="index.php?menu_id=' . $menu_id . '&action_id=' . $action_id . '" class="btn btn-default btn-sm" role="button">Voltar</a>';
									}
                                    ?>

									<?php
										if($edit=='true'){
										    echo '<a href="add_new_employee.php?menu_id=' . $menu_id . '&action_id=' . $action_id . '&employee_id=' . $employee_id . '" class="btn btn-default btn-sm" role="button">Cancelar</a>';
										}
										if($add=='True'){
										    echo '<a href="index.php?menu_id=' . $menu_id . '&action_id=' . $action_id . '" class="btn btn-default btn-sm" role="button">Cancelar</a>';
										}
                                    ?>
                                    <!--<a href="#" class="btn btn-primary btn-sm" role="button">Add user</a>    -->
                                </div>
								
								<div class="modal fade" id="deleteModal">
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;Atenção!</h4>
									  </div>
									  <div class="modal-body">
										<p>Você quer apagar este registro?</p>
									  </div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary btn-sm" id="deleteBtn">Sim</button>
											<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Não</button>
										</div>
									</div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
                                    
								
								
                                
                                <div class="btn-group pull-right">
                                    <a href="index.php?menu_id=<?php echo $menu_id;?>&action_id=<?php echo $action_id;?> class="btn btn-default btn-sm role="button"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                                    <a href="" class="btn btn-default btn-sm active"role="button"><span class="glyphicon glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>
                                </div>
                                
                                <!-- NEXT - PREV BUTTONS RIGHT FUNCTION-->
                                <?php //next_prev_btn($connection, $menu_id, $action_id, $employee_id); ?>
								<!-- END NEXT - PREV BUTTONS RIGHT FUNCTION-->
                            </div>
                        </div>
                        
                        <hr class="line">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-offset-2"> 
												<?php if($edited == "success"): ?>
												<?php echo '<div  id="successMessage" class="alert alert-success alert-dismissible" role="alert">';?>
												<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';?>
												<?php echo '<strong>Atenção!</strong> Successo!';?>
												<?php echo '</div>';?>
												<?php $_SESSION["edited"] = False; ?>
												<?php endif; ?>
												<?php if($edited == "fail"): ?>
												<?php echo '<div id="successMessage" class="alert alert-warning alert-dismissible" role="alert">';?>
												<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';?>
												<?php echo '<strong>Atenção!</strong>Algo errado!';?>
												<?php echo '</div>';?>
												<?php $_SESSION["edited"]=False; ?>
												<?php endif; ?>											
												<div class="panel panel-default">
                                                    <!-- Default panel contents -->
                                                    <h4><div class="panel-heading">Formulário de registro</div></h4>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="save_new_employee.php?menu_id=<?php echo $menu_id . '&action_id='. $action_id . '&employee_id=' . $employee_id; ?>" method="POST" id="save_employee"  class="form-horizontal" accept-charset="UTF-8">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <fieldset>
                                                                                <!-- Form Name -->
                                                                                <legend><h4>
Dados pessoais</h4></legend>   
                                                                                <!-- Select Basic -->
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="selectbasic">Nome:</label>
                                                                                    <div class="col-md-9">
                                                                                        <div class='input-group name' id='datetimepicker'>
																						  <input type="text" class="form-control input-sm" required id="empl_name" value="<?php echo $name; ?>" name="empl_name" <?php if($edit != 'true' && $add!='True') echo 'disabled'; ?>/> 
                                                                                         <span class="input-group-addon">
                                                                                            <span placeholder class="glyphicon glyphicon-user"></span>
                                                                                         </span>
                                                                                       </div>
                                                                                    </div>   
                                                                                </div>
                                                                                <!-- Text input-->
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textinput">Data / Nasc:</label>  
                                                                                    <div class="col-md-9">		
																						<div class='input-group date' id='date'>
																							<input type='date' class="form-control input-sm" required value="<?php echo $date; ?>" name="date" <?php if($edit != 'true'&& $add !='True') echo 'disabled'; ?>/> 
																							<span class="input-group-addon">
																								<span placeholder class="glyphicon glyphicon-calendar"></span>
																							</span>
																						</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textinput">Celular:</label>  
                                                                                    <div class="col-md-9">
                                                                                        <div class='input-group tel' id='tel'>
                                                                                            <Input type = "text" classe = "input-medium bfh-phone" data-formato = "+ 1 (ddd) ddd-dddd"   placeholder ="00 00000 0000" required id="tel" class="form-control input-sm" value="<?php echo $telephone; ?>" name="tel" <?php if($edit != 'true' && $add!='True') echo 'disabled'; ?>/> 
                                                                                            <span class="input-group-addon">
                                                                                                <span class="glyphicon glyphicon-phone"></span>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>    
                                                                                </div>
																				<div class="form-group">
                                                                                    <label class="col-md-3 control-label" for="textinput">E-mail:</label>  
                                                                                    <div class="col-md-9">
                                                                                        <div class='input-group email' id='email'>
                                                                                            <input type="email" placeholder="me@example.com" class="form-control input-sm" required id="email" value="<?php echo $email; ?>" name="email" <?php if($edit != 'true' && $add!='True') echo 'disabled'; ?>/>               
                                                                                            <span class="input-group-addon">
                                                                                                 <span class=" glyphicon glyphicon-envelope"></span>
                                                                                            </span>
                                                                                        </div>     
                                                                                    </div>
                                                                                </div>          
																				<div class="form-group">																		
																					<label class="col-md-3 control-label" for="textinput">Foto:</label> 
																					<div class="col-md-9">
                                                                                        <div class='input-group foto' id='foto'>										
																					       <input type="file" class="form-control input-sm" required id="foto" value="<?php echo $foto; ?>" 
																						  name="foto" <?php if($edit != 'true' && $add!='True') echo 'disabled'; ?>/>
                                                                                          <span class="input-group-addon">
                                                                                               <span placeholder class="glyphicon glyphicon-camera"></span>
                                                                                          </span>
                                                                                        </div>      
																					</div>																			
																			    </div>
																			</fieldset>
																		  </div>  	
                                                                        
																		<div class="col-md-6">
                                                                            <fieldset>
                                                                                <legend><h4>&nbsp;</h4></legend> 
                                                                                <div class="form-group">
                                                                                <!--    <label class="col-md-3 control-label" for="radios">სქესი</label>
                                                                                    <div class="col-md-9"> 
                                                                                            <label class="radio-inline" for="radios-0">
                                                                                                <input name="sex" id="radios-0"  value="1"  type="radio" checked <?php if($edit != 'true'&& $add!='True') echo 'disabled'; ?>/> 
                                                                                                მამ.
                                                                                            </label> 
                                                                                            <label class="radio-inline" for="radios-1">
                                                                                                <input name="sex" id="radios-1" value="0" type="radio" <?php if($edit != 'true' && $add!='True') echo 'disabled'; ?>/> 
                                                                                                მდედ.
                                                                                            </label>
                                                                                    </div>
                                                                                </div> -->
																				
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row (nested) -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
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
        <!-- jQuery -->
    <script src="../base/js/jquery.js"></script>
    <script src="../base/js/bootstrap-select.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../base/js/bootstrap.min.js"></script>
	<script src="https://raw.githubusercontent.com/eternicode/bootstrap-datepicker/master/js/bootstrap-datepicker.js"></script>
	<!-- Menu Toggle Script -->
    <script>

		
	$(document).ready(function(){
         $(function () {
                $('#datetimepicker1').datepicker({ Default: 0, });
            });
    });
	
	$(function(){
		$('#deleteBtn').click(function(e){
			e.preventDefault();
			window.location.href = ' <?php echo 'delete_employee.php?menu_id=' . $menu_id . '&action_id=' . $action_id . '&employee_id='. $employee_id ?>';
		});
	});
	  
		
    //setTimeout(function() {
    //    $('#successMessage_disable').fadeOut("slow");
    //}, 1000); // <-- time in milliseconds 
        
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
        
	        
    //$(document).ready(function () {
    //    var mySelect = $('#first-disabled2');
    //
    //    $('#special').on('click', function () {
    //      mySelect.find('option:selected').prop('disabled', true);
    //      mySelect.selectpicker('refresh');
    //    });
    //
    //    $('#special2').on('click', function () {
    //      mySelect.find('option:disabled').prop('disabled', false);
    //      mySelect.selectpicker('refresh');
    //    });
    //
    //    //$('#basic2').selectpicker({
    //    //  liveSearch: true,
    //    //  maxOptions: 1
    //    //});		
    //});
    
    
    
    </script>

</body>

</html>
