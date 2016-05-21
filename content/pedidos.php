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
								<th>Fecha</th>
								<th>Cliente</th>
								<th>Vendedor</th>
								<th>Duracion</th>
								<th>Monto</th>
								<th>Aprobado</th>
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


<script type="text/javascript">
			var dt;
			$(document).ready(function() {
				dt = $('#dynamic-table').dataTable( {
				ajax: '/panel/assets/main/exec.php?action=get_cobranzas',
				columns: [
					{ "data": "corcobranza" },
					{ "data": "sc_creado" },
					{ "data": "nombre" },
					{ "data": "vendedor",
				    	"render": function (data) {
								return "vendedor";			    		
				    	}
				    },
					{ "data": "duracion" },
					{ "data": "mpag" },
					{ "data": "cacob" }
				],
				 "language": {
                "url": "assets/js/dataTables/Spanish.json"
            }
			} )
		});
		function convertTimestamp(timestamp) {
		  var d = new Date(timestamp * 1000),	// Convert the passed timestamp to milliseconds
				yyyy = d.getFullYear(),
				mm = ('0' + (d.getMonth() + 1)).slice(-2),	// Months are zero based. Add leading 0.
				dd = ('0' + d.getDate()).slice(-2),			// Add leading 0.
				hh = d.getHours(),
				h = hh,
				min = ('0' + d.getMinutes()).slice(-2),		// Add leading 0.
				ampm = 'AM',
				time;
					
			if (hh > 12) {
				h = hh - 12;
				ampm = 'PM';
			} else if (hh === 12) {
				h = 12;
				ampm = 'PM';
			} else if (hh == 0) {
				h = 12;
			}
			time = yyyy + '-' + mm + '-' + dd + ', ' + h + ':' + min + ' ' + ampm;
			return time;
		}

		function modal() {
			$('#clientes').modal('show')
		}

table.columns.adjust().draw();
		// }

</script>
<script src="https://www.google.com/jsapi?callback=loadGoogleApi" type="text/javascript"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true&callback=loadMapApi" type="text/javascript"></script>


