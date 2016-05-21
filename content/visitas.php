<script type="text/javascript">
	$('.nav-list li.active').removeClass('active');
	$('#sidebar li.visitas').addClass('active').parents('.nav-list li').addClass('active');	
</script>
<title>Visitas a Clientes</title>

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
			<div class="col-xs-12">
				<!-- <h3 class="header smaller lighter blue">jQuery dataTables</h3> -->
				<div class="input-daterange input-group" id="datepicker">
				    <input type="text" class="input-sm form-control" name="start" />
				    <span class="input-group-addon"><i class="fa fa-exchange" aria-hidden="true"></i></span>
				    <input type="text" class="input-sm form-control" name="end" />
				</div>
				<div class="clearfix">
					<div class="pull-right tableTools-container"></div>
				</div>
				<div class="table-header">Visitas a Clientes</div>

				<!-- div.table-responsive -->

				<!-- div.dataTables_borderWrap -->
				<div>
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Cliente</th>
								<th>Vendedor</th>
								<th>Duracion</th>
								<th>Motivo/Gestion</th>
								<th>Pedido/Pres.</th>
								<th>Cobranzas</th>
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
	$('.input-daterange').datepicker({
			autoclose	: true,
			language		: "es",
			weekStart	: 7
		}
	);
			var dt;
			$(document).ready(function() {
				dt = $('#dynamic-table').dataTable( {
				ajax: '/panel/assets/main/exec.php?action=get_visitas',
				columns: [
					{ "data": "sc_creado"  ,
				    	"render": function (data) {
							var date = new Date(convertTimestamp(data));
							console.log(date)
							return date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear() +"<br>"+ date.getHours() + ":" +  date.getMinutes();					
				    	}
				    },
					{ "data": null ,
				    	"render": function ( data, type, row) {
								return row.cliente + "|" + row.nombre;
				    	}},
					{ "data": "sc_vendedor" },
					{ "data": "duracion",
						"render": function (data) {
							return (data/60).toFixed(2) + " Min."
						}},
					{ "data": "motivo"},
					{ "data": "cped" ,
				    	"render": function (data, type, row) {
				    		if (data>0) {
				    			return '<a href="lib/jcontent/pedido.php?c='+row.codigo+'&v='+row.sc_vendedor+'" class="poplink" data-width="700">'+row.corpedido.indexOf("COT");+'<br/> <b>'+data+' </b> | <span>Bs. '+(row.mped)+'</span></a>'
				    		} else {
								return data;
							}}
				   },
					{ "data": null,
				    	"render": function (data, type, row) {
				    		if ((row.mpag)>0) {
				    			returnmpag = '<a href="lib/jcontent/pedido.php?c='+row.codigo+'&v='+row.sc_vendedor+'" class="poplink" data-width="700">'+row.ncobra+'<br/> <b>'+row.cped+' </b> | <span>Bs. '+(row.mpag)+'</span></a>'
				    		} else {
								returnmpag = row.cped;
							}			    		
				    		if (row.cacob>0) {
				    			returncacob ='<i class="fa fa-minus" aria-hidden="true"></i>'
				    		} else {
								returncacob ='<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>';
							}
							return returnmpag + " | " + returncacob
				    	}
				    },
					{ "data": null,
				    	"render": function (data, type, row) {
				    		if (((row.deps)>0)&&((row.ncobra)>0)) {
				    			return '<a class="poplink" title="Detalle del deposito" href="lib/jcontent/deps.php?c='+row.ncobra+' style="cursor:pointer;"><img src="img/dollar-exchange.png" width="24"/></a>'
				    		}
				    		return ""
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
