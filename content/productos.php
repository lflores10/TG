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

<!-- page specific plugin scripts -->
<script type="text/javascript">
	var scripts = [
		null,
		"assets/js/dataTables/jquery.dataTables.js",
		"assets/js/dataTables/dataTables.bootstrap.js",
		null]
	$('.page-content-area').ace_ajax('loadScripts', scripts, function() {
		//inline scripts related to this page
		jQuery(function($) {
			//initiate dataTables plugin
			var oTable1 = $('#dynamic-table').dataTable( {
				ajax: '/panel/assets/main/exec.php?action=get_clientes',
				responsive: true,
				columns: [
					{ "data": "codigo" },
					{ "data": "nombre" },
					{ "data": "cxc" },
					{ "data": "vend"},
					{ "data": "uvisita" ,
				    	"render": function (data) {
				    		if (!data) {return "Nunca visitado"}
				    		else {
								var date = new Date(convertTimestamp(data));
								return date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();				    			
				    		}
				    	}
				    },
					{ "data": "pvisita"  ,
				    	"render": function (data) {				    		
				    		if (!data) {return "No programada"}
				    		else {
								var date = new Date(convertTimestamp(data));
								return date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
							}
				    	}}
				],
				 "language": {
                "url": "assets/js/dataTables/Spanish.json"
            }
			} );
		});
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
	
	// ie: 2013-02-18, 8:35 AM	
	time = yyyy + '-' + mm + '-' + dd + ', ' + h + ':' + min + ' ' + ampm;
		
	return time;
}

</script>
