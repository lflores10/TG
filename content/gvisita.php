<?
	include('../main.php');
	
	if($_POST["id"]){
		mysqli_query($mysqli_link,"update scclientes set sc_vendedor = '$vnd', visita = '$vis', intervalo='$int', dias='$di', finicio='".(date("Y-m-d H:i:s",strtotime(str_replace("/","-",$fini))))."', sc_editado='".strtotime('now')."' where ".getQVen()." and sc_eliminado=0 and codigo='$id'");
		die('OK');
	}
	
	$cli=mysqli_fetch_array(mysqli_query($mysqli_link,"select * from scclientes where ".getQVen()." and sc_eliminado=0 and codigo like '$c'"));
?>
<h2 style="color:#069">Programar visita para <em style="color:#39F"><?=$cli["nombre"]?></em></h2>
<hr />
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td width="120" align="right">Vendedor asignado:</td>
    <td width="100"><select style="width:200px;" id="cli_vnd">
        <?
        	$sql2=mysqli_query($mysqli_link,"select * from vendedores where cliente = ".$_SESSION['user-panel']['cliente']);
			while($row2=mysqli_fetch_array($sql2)){
				?><option <?=$cli["sc_vendedor"]==$row2['id']?'selected="selected"':''?> value="<?=$row2['id']?>"><?=$row2['nombre']?></option><?	
			}
		?>
    </select></td>
    <td align="right" width="100">Activar visita:</td>
  	<td><input id="cli_vis" <?=$cli["visita"]==1?'checked="true"':''?> type="checkbox" value="1" /></td>
  </tr>
  <tr>
    <td align="right">Fecha de inicio:</td>
    <td><input type="text" id="cli_fini" value="<?=$cli["finicio"]=="0000-00-00 00:00:00"?date("d/m/Y"):date("d/m/Y",strtotime($cli["finicio"]))?>" size="10" /></td>
    <td align="right">Intervalo en d&iacute;as:</td>
    <td><input type="number" id="cli_int" value="<?=$cli["intervalo"]?>" size="3" style="width:40px;" /></td>
  </tr>
</table><br />
<br />
D&iacute;as en que puede ser visitado el cliente:
<br /><br />
<table width="100%" border="0" style="border:1px solid #999;" cellpadding="5" cellspacing="0" class="gdias">
  <tr>
    <td align="center">Lunes</td>
    <td align="center">Martes</td>
    <td align="center">Miercoles</td>
    <td align="center">Jueves</td>
    <td align="center">Viernes</td>
    <td align="center" style="background-color:#eee">Sabado</td>
    <td align="center" style="background-color:#eee">Domingo</td>
  </tr>
    <tr>
    <td align="center"><input type="checkbox" value="2" <?=strstr($cli["dias"],"2")?'checked="true"':''?> /></td>
    <td align="center"><input type="checkbox" value="3" <?=strstr($cli["dias"],"3")?'checked="true"':''?>/></td>
    <td align="center"><input type="checkbox" value="4" <?=strstr($cli["dias"],"4")?'checked="true"':''?>/></td>
    <td align="center"><input type="checkbox" value="5" <?=strstr($cli["dias"],"5")?'checked="true"':''?>/></td>
    <td align="center"><input type="checkbox" value="6" <?=strstr($cli["dias"],"6")?'checked="true"':''?>/></td>
    <td align="center" style="background-color:#eee"><input type="checkbox" value="7" <?=strstr($cli["dias"],"7")?'checked="true"':''?>/></td>
    <td align="center" style="background-color:#eee"><input type="checkbox" value="1"<?=strstr($cli["dias"],"1")?'checked="true"':''?> /></td>
  </tr>
</table><br />
<br />
<div align="right"><span class="gsave" style="display:none; color:#fff; background-color:#060; border-radius:5px; padding:5px;"><strong>Datos actualizados con exito!</strong></span>
<input type="submit" class="alt_btn" onclick="guardarCli(this); return false;" value="Guardar cambios"  /></div>
<script type="text/javascript">
	function guardarCli(t){
		if($(t).val!="Guardando..."){
			$(t).val('Guardando...');
			var dias ="";
			$(".gdias input:checkbox:checked").each(function(i,e) {
                dias = dias + $(e).val();
            });
			$.ajax({
				url:'lib/jcontent/gvisita.php',
				type:'POST',
				data:{
					id:'<?=$cli["codigo"]?>',
					vnd:$('#cli_vnd').val(),
					vis:$('#cli_vis:checked').val(),
					int:$('#cli_int').val(),
					fini:$('#cli_fini').val(),
					di:dias
				},
				success:function(){
					$(".gsave").show('fast').delay(2000).hide('fast');
					$(t).val('Guardar cambios');
				}	
			});
		}
	}
</script>
<? $x=@mysqli_close($mysqli_link);?>