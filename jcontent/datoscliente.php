<?
	include('../../panel/assets/main/config.php');
	$cli=mysqli_fetch_array(mysqli_query($mysqli_link_data,"select * from scclientes where ".getQVen()." and sc_eliminado=0 and codigo like '$c'"));

   
?>
<h2 style="color:#069">Datos del cliente <em style="color:#39F"><?=$cli["nombre"]?></em></h2>
<hr />
<div style="width:100%; height:250px; overflow:auto;">
<table width="100%" border="0" cellpadding="10" cellspacing="0">
   <tr>
    <td width="120"><strong>Nombre:</strong></td>
    <td><?=$cli[nombre]?></td>
   </tr>
   <tr>
    <td><strong>RIF / Cedula:</strong></td>
    <td><?=$cli[rif]?></td>
   </tr>
   <tr>
    <td><strong>Direci&oacute;n:</strong></td>
    <td><?=$cli[direccion]?></td>
   </tr>
   <tr>
    <td><strong>Correo:</strong></td>
    <td><?=$cli[email]?></td>
   </tr>
   <tr>
    <td><strong>Tel&eacute;fonos:</strong></td>
    <td><?=$cli[telefono]?></td>
   </tr>
   <?
   $data = json_decode($cli[data]);
   if(strlen($data)>0){
     foreach($data as $r){
  	 ?>
     <tr>
      <td><strong><?
      echo $r->k;
  	?></strong></td>
      <td><?=$r->v?></td>
     </tr> 
  	 <?   
      }     
    }
   ?>
</table>
</div><? $x=@mysqli_close($mysqli_link);?>