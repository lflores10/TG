<? session_start();
if(!isset($_SESSION["user"])){
		header("Location: ../tecnoadmin/login.php");
		die;
	}
	include("assets/main/config.php");
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>TecnoAdmin</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/panel/assets/css/bootstrap.css" />
		<link rel="stylesheet" href="/panel/assets/css/font-awesome.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="/panel/assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="/panel/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="/panel/assets/css/ace-skins.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="/panel/assets/css/main.css"/>

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="/panel/assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="/panel/assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='/panel/assets/js/jquery.js'>"+"<"+"/script>");
		</script>
		<script src="/panel/assets/js/ace-extra.js"></script>
		<script src="/panel/assets/js/main.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="/panel/assets/js/html5shiv.js"></script>
		<script src="/panel/assets/js/respond.js"></script>
		<![endif]-->
	</head>

	<body class="skin-1">
		<!-- #section:basics/navbar.layout -->
		
		<? include("head.php"); ?>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<? include("content/mp.php"); ?>

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
					<?

					$p=$p?$p:"index";
					$f = "content/$p.php";

					include(file_exists($f)?$f:"content/404.php");

					?>
					
					
					</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->


		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='/panel/assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='/panel/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="/panel/assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="/panel/assets/js/excanvas.js"></script>
		<![endif]-->
		<script src="/panel/assets/js/jquery-ui.custom.js"></script>
		<script src="/panel/assets/js/jquery.ui.touch-punch.js"></script>
		<script src="/panel/assets/js/jquery.easypiechart.js"></script>
		<script src="/panel/assets/js/jquery.sparkline.js"></script>
		<script src="/panel/assets/js/flot/jquery.flot.js"></script>
		<script src="/panel/assets/js/flot/jquery.flot.pie.js"></script>
		<script src="/panel/assets/js/flot/jquery.flot.resize.js"></script>		
		<script src="/panel/assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="/panel/assets/js/dataTables/dataTables.bootstrap.js"></script>

		<!-- ace scripts -->
		<script src="/panel/assets/js/ace/elements.scroller.js"></script>
		<script src="/panel/assets/js/ace/elements.colorpicker.js"></script>
		<script src="/panel/assets/js/ace/elements.fileinput.js"></script>
		<script src="/panel/assets/js/ace/elements.typeahead.js"></script>
		<script src="/panel/assets/js/ace/elements.wysiwyg.js"></script>
		<script src="/panel/assets/js/ace/elements.spinner.js"></script>
		<script src="/panel/assets/js/ace/elements.treeview.js"></script>
		<script src="/panel/assets/js/ace/elements.wizard.js"></script>
		<script src="/panel/assets/js/ace/elements.aside.js"></script>
		<script src="/panel/assets/js/ace/ace.js"></script>
		<script src="/panel/assets/js/ace/ace.ajax-content.js"></script>
		<script src="/panel/assets/js/ace/ace.touch-drag.js"></script>
		<script src="/panel/assets/js/ace/ace.sidebar.js"></script>
		<script src="/panel/assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="/panel/assets/js/ace/ace.submenu-hover.js"></script>
		<script src="/panel/assets/js/ace/ace.widget-box.js"></script>
		<script src="/panel/assets/js/ace/ace.settings.js"></script>
		<script src="/panel/assets/js/ace/ace.settings-rtl.js"></script>
		<script src="/panel/assets/js/ace/ace.settings-skin.js"></script>
		<script src="/panel/assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="/panel/assets/js/ace/ace.searchbox-autocomplete.js"></script>

		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<!-- <link rel="stylesheet" href="/panel/assets/css/ace.onpage-help.css" /> -->
		<!-- <link rel="stylesheet" href="../docs/panel/assets/js/themes/sunburst.css" /> -->

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="/panel/assets/js/ace/elements.onpage-help.js"></script>
		<script src="/panel/assets/js/ace/ace.onpage-help.js"></script>
	</body>
</html>
