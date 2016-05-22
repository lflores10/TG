<script type="text/javascript">
	$('.nav-list li.active').removeClass('active');
	$('#sidebar li.productos').addClass('active').parents('.nav-list li').addClass('active');	
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
					Listado de Productos
				</div>

				<!-- div.table-responsive -->

				<!-- div.dataTables_borderWrap -->
				<div>
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Foto</th>
								<th>Descripcion</th>
								<th>varios -.-!</th>
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

<!-- page specific plugin scripts -->
<script type="text/javascript">
	var dt;
			$(document).ready(function() {
				dt = $('#dynamic-table').dataTable( {
				ajax: '/panel/assets/main/exec.php?action=get_productos',
				columns: [
					{ "data": null ,
				    	"render": function ( data, type, row) {
								return "foto aqui ";
				    	}
				   },{ 
				   	"data": null ,
				    	"render": function ( data, type, row) {
								htm = '<span style="font-size:20px;" >'+row.nombre+'</span><br/>'
								htm += '<span style="font-size:12px;color:#555;">Codigo: '+row.codigo+'</span><br/>'
								htm += '<span style="font-size:12px;color:green;">Precio: '+row.precio+'</span><br/>'
								htm += '<span style="font-size:12px;color:#555;">Existencia: '+row.existencia+'</span>'
								return htm;
				    	}
				   },{ 
				   	"data": null ,
				    	"render": function ( data, type, row) {
								html = '<ul class="dropdown-menu dropdown-danger" style="display: block;position: static;">'
								html += '   <li  class="dropup dropdown-hover"><i class="fa fa-tasks fa-2x fa-fw"></i>'
								html += '  <ul class="dropdown-menu dropdown-menu-left"> <li><a tabindex="-1" href="#">Another action</a></li>'
								html += '   <li><a tabindex="-1" href="#">Something else here</a></li>'
								html += ' </ul></li></ul>'
								return html;
				    	}
				   }
				],
				 "language": {
                "url": "assets/js/dataTables/Spanish.json"
            }
			} )
		});

</script>
