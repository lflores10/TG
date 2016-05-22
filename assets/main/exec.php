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
			break;case 'get_cobranzas':
			
			$strq="1";

			if($_SESSION['user']['tipo']=='franquicia'){
				$strq=" franquicia = '".$_SESSION['user']['data']['id']."'";
			}

				$eqSel="select
						scvisitas.*, 
					    inicio as fecha,
						corcobranza as ncobra,
					 	(fin-inicio) as duracion,
					 	(select count(*) from scdepositos where cobranzas like concat('%',scvisitas.corcobranza,',%') and scdepositos.sc_vendedor=scvisitas.sc_vendedor) as deps,
					 	(select count(*) from documentosgestion where documento = scvisitas.codigo and status=1 and tipo = 'cob') as cacob,
					 	(select count(*) from scfotosvisita where visita=scvisitas.codigo) as fots,
						(select nombre from scclientes where scclientes.codigo = scvisitas.cliente and scclientes.sc_vendedor=scvisitas.sc_vendedor limit 1) as nombre,
						/*(select nombre from vendedores where id=sc_vendedor) as vendedor,*/
						(select sum(monto) from sccobranzafacturas where visita = scvisitas.codigo and sccobranzafacturas.sc_vendedor=scvisitas.sc_vendedor) as mpag
					from 
						scvisitas 
					where 
						 sc_vendedor !='' and 
					     sc_eliminado=0
					     /*".($vnd!=""?" and sc_vendedor='$vnd'":'').$add." 
					     and (CAST(FROM_UNIXTIME(sc_creado) as date) between '$fd' and '$fh')*/ 
					     and length(corcobranza)>2";

			$sql=mysqli_query($mysqli_link_data,$eqSel);
			while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$row['clave']='';
				// $row['rid']='<small>'.get_uid($row['id']).'</smal>';
				// $row['actions']='<a class="btn btn-xs btn-info" title="Editar"><i class="fa fa-edit"></i> Editar</a>';
				$data["data"][]=$row;
			}
			break;
		case 'get_cobranzas':
			
			$strq="1";

			if($_SESSION['user']['tipo']=='franquicia'){
				$strq=" franquicia = '".$_SESSION['user']['data']['id']."'";
			}

				$eqSel="select
						scvisitas.*, 
					    inicio as fecha,
						corcobranza as ncobra,
					 	(fin-inicio) as duracion,
					 	(select count(*) from scdepositos where cobranzas like concat('%',scvisitas.corcobranza,',%') and scdepositos.sc_vendedor=scvisitas.sc_vendedor) as deps,
					 	(select count(*) from documentosgestion where documento = scvisitas.codigo and status=1 and tipo = 'cob') as cacob,
					 	(select count(*) from scfotosvisita where visita=scvisitas.codigo) as fots,
						(select nombre from scclientes where scclientes.codigo = scvisitas.cliente and scclientes.sc_vendedor=scvisitas.sc_vendedor limit 1) as nombre,
						/*(select nombre from vendedores where id=sc_vendedor) as vendedor,*/
						(select sum(monto) from sccobranzafacturas where visita = scvisitas.codigo and sccobranzafacturas.sc_vendedor=scvisitas.sc_vendedor) as mpag
					from 
						scvisitas 
					where 
						 sc_vendedor !='' and 
					     sc_eliminado=0
					     /*".($vnd!=""?" and sc_vendedor='$vnd'":'').$add." 
					     and (CAST(FROM_UNIXTIME(sc_creado) as date) between '$fd' and '$fh')*/ 
					     and length(corcobranza)>2";

			$sql=mysqli_query($mysqli_link_data,$eqSel);
			while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$row['clave']='';
				// $row['rid']='<small>'.get_uid($row['id']).'</smal>';
				// $row['actions']='<a class="btn btn-xs btn-info" title="Editar"><i class="fa fa-edit"></i> Editar</a>';
				$data["data"][]=$row;
			}
		break;
		case 'get_visitas':
			
			$strq="1";

			if($_SESSION['user']['tipo']=='franquicia'){
				$strq=" franquicia = '".$_SESSION['user']['data']['id']."'";
			}

				$eqSel="select 
				scvisitas.*, 
			    inicio as fecha,
				corcobranza as ncobra,
			 	(fin-inicio) as duracion,
			 	(select count(*) from scdepositos where cobranzas like concat('%',scvisitas.corcobranza,',%') and scdepositos.sc_vendedor=scvisitas.sc_vendedor) as deps,
			 	(select count(*) from documentosgestion where documento = scvisitas.codigo and status=1 and tipo = 'cob') as cacob,
			 	(select count(*) from scfotosvisita where visita=scvisitas.codigo) as fots,
				(select nombre from scclientes where scclientes.codigo = scvisitas.cliente and scclientes.sc_vendedor=scvisitas.sc_vendedor limit 1) as nombre,
				(select count(*) from scpedidos where visita = scvisitas.codigo and scpedidos.sc_vendedor=scvisitas.sc_vendedor) as cped,
				(select sum(total) from scpedidos where visita = scvisitas.codigo and scpedidos.sc_vendedor=scvisitas.sc_vendedor) as mped,
				(select sum(monto) from sccobranzafacturas where 
				visita = scvisitas.codigo and sccobranzafacturas.sc_vendedor=scvisitas.sc_vendedor) as mpag
			    from scvisitas
			     where sc_vendedor !='' and sc_eliminado=0";

			$sql=mysqli_query($mysqli_link_data,$eqSel);
			while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				// $row['clave']='';
				// $row['rid']='<small>'.get_uid($row['id']).'</smal>';
				// $row['actions']='<a class="btn btn-xs btn-info" title="Editar"><i class="fa fa-edit"></i> Editar</a>';
				$data["data"][]=$row;
			}
		break;
		case 'get_productos':
			$eqSel = "select * from scproductos where ".getQCli()." and sc_eliminado=0 and sc_cliente = 2" ;//.$_SESSION['user']['data']['id'];
			$sql=mysqli_query($mysqli_link_data,$eqSel);
			$data['count']=mysqli_num_rows($sql);
			while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$data["data"][]=$row;
			}
			break;
		default;
	}
}
echo json_encode($data);
?>