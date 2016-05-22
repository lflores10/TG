<?

	session_start();
date_default_timezone_set('America/Caracas');
header('Content-Type: text/html; charset=UTF-8');

$mysqli_link = mysqli_connect(
	"localhost",
	"root",
	"12345",
	"tcmaster") or exit("No se puede conectar");

$mysqli_link_data = mysqli_connect(
	"localhost",
	"root",
	"12345",
	"tecnoplu_tpdata") or exit("No se puede conectar");


extract($_GET);
extract($_POST);
function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
} 
function get_uid($s,$t=''){
	return substr(chunk_split(strtoupper(md5("tp$t$s")), 4, '-'),5,19);
}
function get_status_service($s, $md = false){
	
	global $mysqli_link;
	
	$sql2=mysqli_query($mysqli_link,"select count(*) from ordenes where status=1 and inicio<='".date("Y-m-d")."' and fin>='".date("Y-m-d")."' and ".($md?"md5(servicio)":"servicio")."='$s'");
	$rowz=mysqli_fetch_array($sql2);
	return $rowz[0];

}

function getQCli(){
	return "sc_cliente != ''";
}
function getQVen(){
	return "sc_vendedor !=''";
}
function get_data_service($s){
	global $mysqli_link;
	$sql=mysqli_query($mysqli_link,"select * from servicios where id='$s' and status = 1");
    if(mysqli_num_rows($sql)>0){
       	$row=mysqli_fetch_array($sql);
        return array_merge($row,json_decode(base64_decode($row['config']),true));
    }
	return null;
}

function licencias_disponibles($f, $s, $p=null, $c=null){
	
	global $mysqli_link;
	
	$planes = array();

	$sqlp=mysqli_query($mysqli_link,"select * from planes where status=1".($p!=null?" and id=$p":""));
	while($rowp=mysqli_fetch_array($sqlp)){

		
		$sql=mysqli_query($mysqli_link,"select count(*) from ordenes where status=1 and plan = ".$rowp['id']." and servicio in (select id from servicios where servicios.servicio='$s' and cliente in (select id from clientes where franquicia=$f))");
		$row=mysqli_fetch_array($sql);
		$activas = $row[0];

		$sql=mysqli_query($mysqli_link,"select sum(cant) from paquetes where status=1 and servicio = '$s' and franquicia=$f and plan = ".$rowp['id']);
		$row=mysqli_fetch_array($sql);
		$disponible = $row[0];
		
		if($rowp['unico']==1 && $c!=null){

			$sql=mysqli_query($mysqli_link,"select count(*) from ordenes where status= 1 and plan = ".$rowp['id']." and servicio in (select id from servicios where servicios.servicio='$s' and cliente = $c)");
			$row=mysqli_fetch_array($sql);
			if($row[0]>0){
				$rowp['disponible'] = 0;
			} else {
				$rowp['disponible'] = $disponible - $activas;
			}
		
		} else {
			
			$rowp['disponible'] = $disponible - $activas;

		}

		//die("select sum(cant) from paquetes where servicio = '$s' and franquicia=$f and plan = ".$rowp['id']);
		

		$planes[] = $rowp;

	}

	return $planes;

}

$_M = array(
	"index"=>array("cliente","admin","franquicia"),
	"clientes"=>array("admin","franquicia"),
	"servicios"=>array("admin","franquicia"),
	"franquicias"=>array("admin"),
	"planes"=>array("admin"),
	"paquetes"=>array("admin"),
	"cuenta"=>array("franquicia"),
	"descargas"=>array("cliente","admin","franquicia")
	);

?>
