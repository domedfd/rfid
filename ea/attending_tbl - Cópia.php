?>
<div class="col-md-4">
	<a href="../ea/?menu_id=2" class="thumbnail bg-red">
			<div class="row">
					<div class="col-sm-12">
						<h5><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Acesso Geral <span class="label label-warning"><?php $data = date('d/m/Y'); echo $data .= ' '.date('H:i:s'); ?></span></h5>
						<h5>Controle de Entrada e saidas</h5>
					</div>
			</div>
	</a>
</div>

<div class="col-md-4">
	<a href="../ea/?menu_id=2" class="thumbnail bg-red">
			<div class="row">
					<div class="col-sm-12">
						<h5><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Acesso Geral <span class="label label-warning"><?php $data = date('d/m/Y'); echo $data .= ' '.date('H:i:s'); ?></span></h5>
						<h5>Controle de Entrada e saidas</h5>
					</div>
			</div>
	</a>
</div>
<?php 
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
echo '<th>Horário</th>';
echo '<th class="text-center">Tempo</th>';
echo '<th class="text-center">Status</th>';
echo '<th class="text-center">Entrada</th>';
echo '<th class="text-center">ID Cartão</th>';
echo '</tr>';
echo '<tbody class="searchable">';
    $i = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        $get_user = "SELECT * FROM employee WHERE id=".$row['name']." LIMIT 1;";
        $rt = mysqli_query($connection, $get_user);
        $user = mysqli_fetch_array($rt, MYSQLI_ASSOC);
        echo '<td>' . $user['name']. '</td>';
        echo '<td>' . $row['date']. '</td>';
		echo '<td>' . $row['time']. '</td>';	
		
        echo '<td class="text-center">' . $row['timetable']. '</td>';
        echo '<td class="text-center" ';
            if($row['status']=='Entrou') echo "bgcolor=#009a57><font color='#fff'>";
           
            else if($row['status']=='Saiu') echo "bgcolor=#186dee><font color='#fff'>";
            else if($row['status']=='bloqueado') echo "bgcolor=#dc4c38><font color='#fff'>";
            echo $row['status'];
        echo '</font></td>';
        echo '<td class="text-center">' . $row['entrance']. '</td>';
        $card_id = 'SELECT * FROM cards WHERE id="' . $row["card_id"] .'" LIMIT 1;';
        $rt = mysqli_query($connection, $card_id);
        $card_id = mysqli_fetch_array($rt, MYSQLI_ASSOC);
        echo '<td class="text-center">' . $card_id['card_id']. '</td>';
        echo '<tr>';
        $i++;
    endwhile;
echo '</tbody>';
echo '</table>';

?>