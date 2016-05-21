
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
				<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
					<div class="widget-box ">
						<article class="module width_half">
							<header><h3>mensajes</h3></header>
							<div class="message_list">
								<div class="module_content" id="mensajes-lista">

								</div>
							</div>
							<footer>
								<form class="post_message" method="post" onsubmit="return false;" >
									<input type="text" value="Nuevo mensaje" placeholder="Nuevo mensaje" id="nm" name="sms" style="width:75%" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
									<input type="submit" value="Enviar >>" onClick="if($('#nm').val()!=''){ loadMsj(true); } return false;" style="font-size:11px; padding:3px; width:15%;"/>
								</form>
							</footer>
						</article>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 widget-container-col ui-sortable">
					<div class="widget-box ">
						<form class="post_message" method="post" id="form-vend">
					<article class="module width_half">
						<header><h3><input name="" type="checkbox" value="" onclick="checkAll(this);" /> Vendedores</h3></header>
					    <div class="message_list">
					        <div class="module_content">
					        	<?
					            $sql=mysqli_query($mysqli_link,"select * from vendedores where cliente=".$_SESSION['user']['cliente']);
									while($row=mysqli_fetch_array($sql)){
										?><div class="message msj-list">
					                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
					                      <tr>
					                        <td>
					                    <p><input name="smsv[]" type="checkbox" value="<?=$row["id"]?>" /> | <span style="font-size:18px;"><?=utf8_encode($row["nombre"])?></span><br />
					                    <? $sq=mysqli_query($mysqli_link_data,"select mensaje from scmensajes where sc_vendedor='".$row["id"]."' and (status=2 or status=4) and sc_eliminado=0 order by codigo desc limit 1");
											if(mysqli_num_rows($sq)>0){
												echo mysqli_result($sq,0,0);
											} else {
												echo "No tiene mensajes enviados";	
											}
										?>
					                    </p></td>
					                      	<td align="right"><?=mysqli_result(mysqli_query($mysqli_link_data,"select count(*) from scmensajes where sc_vendedor='".$row["id"]."' and status = 2"),0,0)?> sin leer</td>  
					                      </tr>
					                    </table>
					                    </div><?	
									}
								?>
					        </div>
					    </div>
					</article>

					</form>

					<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->

</div><!-- /.row -->


<script type="text/javascript">

	var cd=""; //codigo de eliminacion
	$(document).ready(function(e) {
        $(".message_list").height($(window).height()-220);
		$(".msj-list").click(function(e) {
			$(this).toggleClass("selected");
			$(this).hasClass("selected")?$(this).find("input:checkbox").attr("checked","checked"):$(this).find("input:checkbox").removeAttr("checked");        
			loadMsj(false);
		});
		loadMsj(false);
    });
	function loadMsj(isSend){
		if($("#form-vend input:checked").length>0){
			$("#mensajes-lista").html(strLoading);
			var strQuery = $("#form-vend").serialize();
			$("#mensajes-lista").load('lib/jcontent/mensajes.php?'+strQuery+(isSend?'&ssend='+escape($('#nm').val()):'')+"&cd="+cd,'',function(){
				$(".message_list").scrollTop($(".message_list").height()*2);
			});
		} else {
			$("#mensajes-lista").html('<div align="center" style="padding:20px; font-size:16px;">Seleccione un vendedor de la lista</div>');
		}
		isSend?$('#nm').val(''):$('#nm');
	}
	function checkAll(t){
		if($(t).is(':checked')){
			$('form input:checkbox').attr('checked','checked');
			$('form .message').removeClass('selected').addClass('selected');
		} else {
			$('form input:checkbox').removeAttr('checked');
			$('form .message').removeClass('selected');
		}
		loadMsj(false); 
	}
</script>
