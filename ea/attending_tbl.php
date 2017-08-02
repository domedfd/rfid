<!DOCTYPE html>

<div class="col-md-6">
	<a href="../ea/?menu_id=2" class="thumbnail bg-red">
			<div class="row">
					<div class="col-sm-12">
						<h5><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Acesso Geral<span class="label label-warning"><?php include_once('../config/time.php'); $data = date('d/m/Y'); echo $data .' '.date('H:i:s'); ?></span></h5>
						<h5><div align="center">Controle de Entrada e saidas</div></h5>
					</div>
			</div>
	</a>
</div>
<div class="col-md-6">
	<a href="../ea/?menu_id=2" class="thumbnail bg-red">
			<div class="row">
					<div class="col-sm-12">
						<h5><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Acesso Geral &nbsp&nbsp<span class="label label-warning"><?php $data = date('d/m/Y'); echo $data .' '.date('H:i:s'); ?></span></h5>
						<h5><div align="center">Controle de Entrada e saidas</div></h5>
					</div>
			</div>
	</a>
</div>

<?php 
include_once('../config/time.php');
require_once("../db/db.php");
require_once("../db/db.php");
$query = "SELECT * FROM attendance ORDER BY id DESC LIMIT 30;";
$result = mysqli_query($connection, $query);
    
if(!$result){
    die('QUERY FAILED' . mysqli_errno());
}

echo '<table class="table table-hover table-condensed">';
echo '<tr>';
echo '<th>Cont</th>';
echo '<th>Nome</th>';
echo '<th>Data</th>';
echo '<th class="text-center">Entrada</th>';
echo '<th class="text-center">Tempo</th>';
echo '<th class="text-center">Status</th>';
echo '<th class="text-center">Entrada</th>';
echo '<th class="text-center">Saída</th>';
echo '<th class="text-center">ID Cartão</th>';
echo '</tr>';
echo '<tbody class="searchable">';
    //$dataLocal = date('d/m/Y H:i:s', time());
    $e = 1;
    //$s; 
    $i = 1;    
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):        
        echo '<tr>';
        echo '<td>' . $i . '</td>';        
        $get_user = "SELECT * FROM employee WHERE id=".$row['name']." LIMIT 1;";
        //$sql = date("d/m/Y",strtotime($row['date']));
        $rt = mysqli_query($connection, $get_user);
        $user = mysqli_fetch_array($rt, MYSQLI_ASSOC);        
        echo '<td>' . $user['name']. '</td>';
        //echo '<td>' . $dateLocal = date('d/m/Y') . '</td>'; //echo '<td>' . $row['date']. '</td>';  
		echo "<td>" . date("d/m/Y",strtotime($row['date'])). "</td>";
        //echo '<td>' . $row['date']. '</td>';          
        echo '<td class="text-center" ';        
        echo "< td bgcolor=#009a57><font color='#fff'"; //verde 
            if($row['status']=="Entrou")  echo '<td>'. $row['time'].'</td>';  //d/m/Y”, strtotime($row_noticia[data      
        echo '</td>';
        //echo '<td>' . $row['time']. '</td>';        
		echo '<td class="text-center">' . $row['timetable']. '</td>';
        echo '<td class="text-center" ';
            if($row['status']=="Entrou") echo "bgcolor=#009a57><font color='#fff'>";           
            else if($row['status']=='Saiu') echo "bgcolor=#186dee><font color='#fff'>";
            else if($row['status']=='Bloqueado') echo "bgcolor=#dc4c38><font color='#fff'>";
            echo $row['status'];           
        echo '</font></td>';
        
        echo '<td class="text-center" ';
            if($row['status']=="Entrou") echo  '<td>' . $e . '</td>';          
            else if($row['status']=='Saiu') echo  '<td>' . $e-1  . '</td>';
            //else if($row['status']=='Bloqueado') //echo  '<td>' . $e-1 . '</td>';
            //echo $row['status'];           
        echo '</font></td>';
        
        //echo '<td class="text-center">' . $row['entrance']. '</td>';

       
        //echo '<td>' . $row['time']. '</td>';
        echo '<td class="text-center" ';        
        echo "< td bgcolor=#186dee><font color='#fff'"; //verde 
            if($row['status']=="Saiu")  echo '<td>'. $row['time'].'</td>';        
        echo '</td>';

        $card_id = 'SELECT * FROM cards WHERE id="' . $row["card_id"] .'" LIMIT 1;';
        $rt = mysqli_query($connection, $card_id);
        $card_id = mysqli_fetch_array($rt, MYSQLI_ASSOC);
        echo '<td class="text-center">' . $card_id['card_id']. '</td>';
        
        echo '<tr>';
        $e = 1;
        //$s; 
        $i++;
            
    endwhile;
echo '</tbody>';
echo '</table>';
?>