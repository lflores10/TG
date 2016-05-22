<script type="text/javascript">
	$('.nav-list li.active').removeClass('active');
	$('#sidebar li.clientes').addClass('active').parents('.nav-list li').addClass('active');	
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
								<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
			<!-- <iframe width="400" height="300" frameborder="0" allowfullscreen=""></iframe> -->

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
					{ "data": "cxc" ,
						"render": function (data) {
							if (data>0) {
								return data
							} else {
								return '---'	
							}
							
						}
					},
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
				    	"render": function (data, type, row) {
				    		var page = "'gvisita'"		    		
				    		if (data) {
				    			return data
								var date = new Date(data);
								return date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
				    		}
				    		else {
				    			var cod = "'"+row.codigo+"'"
				    			var cita = '<a title="Programar visita" onclick="modal('+page+','+cod+')" ><i class="ace-icon fa  fa-cogs"></i></a>'
				    			return "No programada" + cita
							}
				    	}
				    },
					{ "data": "codigo" ,
				    	"render": function ( data, type, row) {
				    		var page1 = "'datoscliente'"
				    		var modal = "'"+data+"'"
				    		return '<a title="Programar visita" onclick="modal()" ><i class="ace-icon fa  fa-cogs"></i></a>'
				    	}
				    }
				],
				 "language": {
                "url": "assets/js/dataTables/Spanish.json"
            }
			} )
		});
		function modal(page,n) {
			$('#clientes .modal-body').load('jcontent/'+page+'.php?c='+ n
			,function( response, status, xhr ) {
				$('#clientes').modal('show')
			});
		}

</script>
<!-- <script src="https://www.google.com/jsapi?callback=loadGoogleApi" type="text/javascript"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true&callback=loadMapApi" type="text/javascript"></script> -->


