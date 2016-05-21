<?
	if($dg){
		if(mysqli_query($mysqli_link_data,"update scmotivos set sc_eliminado='".time()."' where ".getQCli()." and codigo='".$dg."'")){
			?>
				<h4 class="alert_success">Motivo de gestion eliminado</h4>
				<script>setTimeout("window.location='./?<?=_SEC_?>=<?=base64_encode('opciones')?>';",2000);</script>
			<?	
		}
	}
	if($ag){
		if(mysqli_query($mysqli_link_data,"insert into scmotivos (codigo,nombre,sc_cliente,sc_creado) values ('".strtotime("now")."','".utf8_decode($ag)."','".$_SESSION['user-panel']['cliente']."','".strtotime("now")."')")){
			?>
				<h4 class="alert_success">Creado con exito</h4>
				<script>setTimeout("window.location='./?<?=_SEC_?>=<?=base64_encode('opciones')?>';",2000);</script>
			<?	
		}
	}
	if($opt){
		mysqli_query($mysqli_link_data,"update scopciones set
		noexistencia=".($noexistencia*1).",
		requirepass=".($requirepass*1).",
		syncinterval=$syncinterval,
		timevis='$timevis',
		changepass=".($changepass*1).",
		trackinterval='".($trackinterval?$trackinterval:2)."',
		sc_editado='".strtotime('now')."'
		where ".getQCli());


    mysqli_query($mysqli_link_data,"update ecomerce set
    recibe_pedido=".($recibe_pedido*1).",
    recibe_cobranza=".($recibe_cobranza*1)."
    where 1");

	}
	$op=mysqli_fetch_array(mysqli_query($mysqli_link_data,"select * from scopciones where sc_cliente != ''"));
  $op2=mysqli_fetch_array(mysqli_query($mysqli_link_data,"select * from ecomerce where 1"));


?>
<title>LISTA DE CLIENTES REGISTRADOS</title>

<!-- ajax layout which only needs content area -->
<!-- <div class="page-header">
	<h1>
		Tables
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Static &amp; Dynamic Tables
		</small>
	</h1>
</div> --><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->

		<div class="row">
			<div class="col-xs-14">
				<!-- <h3 class="header smaller lighter blue">jQuery dataTables</h3> -->

				<div class="clearfix">
					<div class="pull-right tableTools-container"></div>
				</div>
				<div class="table-header">
					LISTA DE CLIENTES REGISTRADOS
				</div>

				<!-- div.table-responsive -->

				<!-- div.dataTables_borderWrap -->
				<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
					<div class="widget-box ">
						<header><h3 class="tabs_involved">opciones en moviles</h3></header>
						<div class="module_content">
					    	<form method="post">
					    	<table width="100%" border="0" cellpadding="13" cellspacing="0">
					          
					          <tr>
					            <td colspan="2">Recibir pedidos</td>
					            <td><input type="checkbox" value="1"<?=$op2["recibe_pedido"]==1?' checked="checked"':''?> name="recibe_pedido"/>&nbsp;</td>
					          </tr>
					          <tr>
					            <td colspan="2">Recibir cobranzas</td>
					            <td><input type="checkbox" value="1"<?=$op2["recibe_cobranza"]==1?' checked="checked"':''?> name="recibe_cobranza"/>&nbsp;</td>
					          </tr>

					          <tr>
					            <td colspan="2" width="30">Permitir agregar a los pedidos productos sin existencia.</td>
					            <td><input type="checkbox" value="1"<?=$op["noexistencia"]==1?' checked="checked"':''?> name="noexistencia"/>&nbsp;</td>
					          </tr>
					          <tr>
					            <td colspan="2">Solicitar contraseña siempre al acceder al sistema.</td>
					            <td><input type="checkbox" value="1"<?=$op["requirepass"]==1?' checked="checked"':''?> name="requirepass"/>&nbsp;</td>
					          </tr>
					          <tr>
					            <td colspan="2">
					            Los precios de los productos incluyen iva.</td>
					            <td><input type="checkbox" value="1"<?=$op["changepass"]==1?' checked="checked"':''?> name="changepass"/>&nbsp;</td>
					          </tr>
					          <tr>
					            <td width="30" colspan="2">Intervalo de sincronizaci&oacute;n en minutos.</td>
					            <td><input type="number" style="width:50px;" min="2" value="<?=$op["syncinterval"]?>" name="syncinterval" /></td>
					          </tr>
					          <? if($op["tracking"]==1) { ?>
					          <tr>
					            <td colspan="2">
					            Intervalo de rastreo en minutos.</td>
					            <td><input type="number" style="width:50px;" min="1" value="<?=$op["trackinterval"]?>" name="trackinterval" />&nbsp;</td>
					          </tr>
					          <? } ?>
					          <tr>
					            <td colspan="2"> Hora para las notificaciones de las visitas del dia.</td>
					            <td><input type="time" value="<?=$op["timevis"]?>" name="timevis" /></td>
					          </tr>
					          <tr>
					            <td align="right" colspan="3"><hr /><input type="submit" name="opt" value="Guardar"/></td>
					          </tr>
					        </table>
					        </form>
					    </div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
				<div class="widget-box">
				    <header><h3>motivos de gestion no efectiva</h3></header>
				    <div class="message_list" style="height:320px;">
				        <div class="module_content">
				        	<?
								$sql=mysqli_query($mysqli_link_data,"select * from scmotivos where sc_cliente != '' and sc_eliminado=0");
								while($row=mysqli_fetch_array($sql)){
									?><div class="message"><p><?=utf8_encode($row["nombre"])?><a href="./?<?=_SEC_?>=<?=base64_encode("opciones")?>&dg=<?=$row["codigo"]?>" onClick="return confirm('Seguro desea eliminar este motivo?');" ><img align="right" src="images/icn_trash.png"></a></p>
				        			</div>
									<?	
								}
							?>
				        </div>
				    </div>
				    <footer>
				        <form class="post_message">
				            <input type="text" value="Nuevo motivo" id="nm" style="width:80%" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
				            <input type="submit" value="Agregar" onClick="window.location='./?<?=_SEC_?>=<?=base64_encode("opciones")?>&ag='+$('#nm').val(); return false;" style="font-size:11px; padding:3px;"/>
				        </form>
				    </footer>
				</div>
			</div>
			</div>
		</div>
		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->

</div><!-- /.row -->


<script type="text/javascript">

</script>


