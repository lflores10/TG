<script type="text/javascript">
	
	
</script>

<title>LISTA DE CLIENTES REGISTRADOS</title>

<!-- ajax layout which only needs content area -->
<div class="page-header">
	<h1>
		Tables
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Static &amp; Dynamic Tables
		</small>
	</h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->

		<div class="row">
			<div class="col-xs-12">
				<!-- <h3 class="header smaller lighter blue">jQuery dataTables</h3> -->

				<div class="clearfix">
					<div class="pull-right tableTools-container"></div>
				</div>
				<div class="table-header">
					LISTA DE CLIENTES REGISTRADOS
				</div>

				<!-- div.table-responsive -->

				<!-- div.dataTables_borderWrap -->
				<div>
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Nombre</th>
								<th>Estado de Cuenta</th>
								<th>Vendedor</th>
								<th>Ultima Visita</th>
								<th>Proxima Visita</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->

<?
	// $cli=mysqli_fetch_array(mysqli_query($mysqli_link_data,"select * from scclientes where  sc_vendedor !='' and sc_eliminado=0 and codigo like '$c'"));
?>

<div class="modal fade" id="clientes" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Programar visita para <em style="color:#39F"><?=$cli["nombre"]?></em></h4>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <a data-dismiss="modal">Close</a>
        <a title="Programar visita" onclick="guardarCli(this); return false;" ><i class="ace-icon fa fa-floppy-o"></i></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
			var dt;
			$(document).ready(function() {
				dt = $('#dynamic-table').dataTable( {
				ajax: '/panel/assets/main/exec.php?action=get_clientes',
				columns: [
					{ "data": "codigo" },
					{ "data": "nombre" },
					{ "data": "cxc" },
					{ "data": "vendedor"},
					{ "data": "uvisita" ,
				    	"render": function (data) {
				    		if (!data) {return "Nunca visitado"}
				    		else {
								var date = new Date(convertTimestamp(data));
								return date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();				    			
				    		}
				    	}
				    },
					{ "data": "pvisita" ,
				    	"render": function (data) {				    		
				    		if (!data) {return "No programada"}
				    		else {
								var date = new Date(convertTimestamp(data));
								return date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
							}
				    	}
				    },
					{ "data": "codigo" ,
				    	"render": function (data) {							
				    		return '<a title="Programar visita" onclick="modal()" ><i class="ace-icon fa  fa-cogs"></i></a><a title="Programar visita" onclick="modal()" ><i class="ace-icon fa  fa-cogs"></i></a>'							
				    	}
				    }
				],
				 "language": {
                "url": "assets/js/dataTables/Spanish.json"
            }
			} )
		});
		

		function modal() {
			$('#clientes').modal('show')
		}

</script>
<script src="https://www.google.com/jsapi?callback=loadGoogleApi" type="text/javascript"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true&callback=loadMapApi" type="text/javascript"></script>


