<?
session_start();
include('config.php');
header('Access-Control-Allow-Origin: *');  
//error_reporting(0);
$data=array('status'=>'OK');

if($action){
	$data=array("data"=>array());
	switch ($action) {
		case 'get_clientes':
			
			$strq="1";

			if($_SESSION['user']['tipo']=='franquicia'){
				$strq=" franquicia = '".$_SESSION['user']['data']['id']."'";
			}

				$eqSel="select 
				*,
				(select max(inicio) from scvisitas where cliente = scclientes.codigo and scclientes.sc_vendedor = scvisitas.sc_vendedor) as uvisita,
				(select nombre from vendedores where id = scclientes.sc_vendedor) as vend,
				(select sum(total) from scfacturas where cliente = scclientes.codigo and scclientes.sc_vendedor = scfacturas.sc_vendedor and scfacturas.sc_eliminado=0) as cxc,
				IF(date('now')<(SELECT min(DATE_ADD(date_add(t1.finicio, interval ((abs(cast(datediff(current_date,t1.finicio)/t1.intervalo as signed)))*t1.intervalo) day),INTERVAL mod(day-DAYOFWEEK(date_add(t1.finicio, interval ((abs(cast(datediff(current_date,t1.finicio)/t1.intervalo as signed)))*t1.intervalo) day))+7,7) DAY)) from scclientes as t1 inner join dias on t1.dias like CONCAT('%',day,'%') where t1.sc_vendedor=scclientes.sc_vendedor and t1.codigo = scclientes.codigo),(SELECT min(DATE_ADD(date_add(t1.finicio, interval ((abs(cast(datediff(current_date,t1.finicio)/t1.intervalo as signed)))*(t1.intervalo+1)) day),INTERVAL mod(day-DAYOFWEEK(date_add(t1.finicio, interval ((abs(cast(datediff(current_date,t1.finicio)/t1.intervalo as signed)))*(t1.intervalo+1)) day))+7,7) DAY)) from scclientes as t1 inner join dias on t1.dias like CONCAT('%',day,'%') where t1.sc_vendedor=scclientes.sc_vendedor and t1.codigo = scclientes.codigo),(SELECT min(DATE_ADD(date_add(t1.finicio, interval ((abs(cast(datediff(current_date,t1.finicio)/t1.intervalo as signed)))*t1.intervalo) day),INTERVAL mod(day-DAYOFWEEK(date_add(t1.finicio, interval ((abs(cast(datediff(current_date,t1.finicio)/t1.intervalo as signed)))*t1.intervalo) day))+7,7) DAY)) from scclientes as t1 inner join dias on t1.dias like CONCAT('%',day,'%') where t1.sc_vendedor=scclientes.sc_vendedor and t1.codigo = scclientes.codigo)) as pvisita
				from scclientes where sc_vendedor !='' and sc_eliminado=0 ";

			$sql=mysqli_query($mysqli_link_data,$eqSel);
			while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$row['clave']='';
				// $row['rid']='<small>'.get_uid($row['id']).'</smal>';
				// $row['actions']='<a class="btn btn-xs btn-info" title="Editar"><i class="fa fa-edit"></i> Editar</a>';
				$data["data"][]=$row;
			}
			break;
		default;
	}
}
echo json_encode($data);
?>