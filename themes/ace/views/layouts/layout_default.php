<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo config_item('app_title') . config_item('title_separator') . $template['title']; ?></title>
		<meta name="description" content="SIMKAT UNIVERSITAS AHMAD DAHLAN" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" type="text/css" href="<?php echo css_path('bootstrap.min.css', '_theme_'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo css_path('font-awesome.min.css', '_theme_'); ?>">
		<!-- page specific plugin styles -->
		<!-- text fonts 
		<link rel="stylesheet" href="<?php echo css_path('font-css.css', '_theme_'); ?>" />
		-->
		<link rel="stylesheet" href="<?php echo css_path('fonts/css.css', '_theme_'); ?>" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo css_path('ace.min.css', '_theme_'); ?>" class="ace-main-stylesheet" id="main-ace-style" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo css_path('ace-part2.min.css', '_theme_'); ?>" />
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="<?php echo css_path('ace-skins.min.css', '_theme_'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo css_path('ace-rtl.min.css', '_theme_'); ?>">
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo css_path('ace-ie.min.css', '_theme_'); ?>" />
		<![endif]-->
		<!-- inline styles related to this page -->
		<?php echo $template['partials']['modules_css']; ?> 
		<!-- basic scripts -->
		<!--[if !IE]> -->
		<script src="<?php echo js_path('jquery-2.1.4.min.js', '_theme_'); ?>"></script>
		<!-- <![endif]-->
		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo js_path('jquery.min.js', '_theme_'); ?>'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<!--[if IE]>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo js_path('jquery1x.min.js', '_theme_'); ?>'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<!-- ace settings handler -->
		<script src="<?php echo js_path('ace-extra.min.js', '_theme_'); ?>"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lte IE 8]>
			<script src="<?php echo js_path('html5shiv.js', '_theme_'); ?>"></script>
			<script src="<?php echo js_path('respond.min.js', '_theme_'); ?>"></script>
		<![endif]-->
		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo js_path('jquery.mobile.custom.min.js', '_theme_'); ?>'>"+"<"+"/script>");
		</script>
		<script src="<?php echo js_path('bootstrap.min.js', '_theme_'); ?>"></script>
		<!-- ace scripts -->
		<script src="<?php echo js_path('ace-elements.min.js', '_theme_'); ?>"></script>
		<script src="<?php echo js_path('ace.min.js', '_theme_'); ?>"></script>
		<?php echo $template['partials']['modules_js']; ?>
		<script type="text/javascript">
			jQuery(function(e){var s=e(".profiler_menu"),i=e("#codeigniter_profiler").find("fieldset");s.click(function(s){that=e(this).attr("href"),e.each(i,function(s,i){e(this).hasClass("show")&&e(this).removeClass("show"),e(this).hide()}),"collapse_all"!=that&&e(that).addClass("show").show()});var a=e(".sidebar").eq(0);a.hasClass("h-sidebar")&&(e(document).on("settings.ace.top_menu",function(s,i,r){if("sidebar_fixed"===i){var t=a.get(0),o=e(window),l=a.ace_sidebar("vars");if(!r||l.mobile_view||l.collapsible)return a.removeClass("lower-highlight"),t.style.marginTop="",void o.off("scroll.ace.top_menu");var n=!1;o.on("scroll.ace.top_menu",function(e){var s=o.scrollTop();s=parseInt(s/4),s>17&&(s=17),s>16?n||(a.addClass("lower-highlight"),n=!0):n&&(a.removeClass("lower-highlight"),n=!1),t.style.marginTop=17-s+"px"}).triggerHandler("scroll.ace.top_menu")}}).triggerHandler("settings.ace.top_menu",["sidebar_fixed",a.hasClass("sidebar-fixed")]),e(window).on("resize.ace.top_menu",function(){e(document).triggerHandler("settings.ace.top_menu",["sidebar_fixed",a.hasClass("sidebar-fixed")])}))});
		</script>
		<style>
		#codeigniter_profiler{max-width:90%;min-width:35em;position:fixed;bottom:0;width:auto;display:block;font-family:Monaco,Menlo,Consolas,"Courier New",monospace}#codeigniter_profiler>fieldset{display:none;margin:0!important}#ci_profiler_menu{margin:0;background:#DDD}#ci_profiler_menu:after{clear:both;content:"";display:table}#ci_profiler_menu ul{list-style-type:none;margin:0;padding:0;float:left}#ci_profiler_menu ul li{display:block;line-height:15px;float:left;margin:0 2px;text-align:center}#ci_profiler_menu ul>li>a{padding:5px 10px 0;text-transform:uppercase;text-decoration:none;display:block;font-weight:bolder}#ci_profiler_menu ul>li>span{font-size:11px}#ci_profiler_queries table tr td{color:#252525}.profiler_default{border-bottom:4px solid #333}.profiler_default a{color:#333}.profiler_blue{border-bottom:4px solid #00F}.profiler_blue a{color:#00F}.profiler_green{border-bottom:4px solid #090}.profiler_green a{color:#090}.profiler_magenta{border-bottom:4px solid #5A0099}.profiler_magenta a{color:#5A0099}.profiler_brown{border-bottom:4px solid #900}.profiler_brown a{color:#900}
		</style>
		<!-- <link rel="shortcut icon" href="<?php echo image_url('fav.png', '_theme_');?>" /> -->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default navbar-collapse h-navbar">
			<!--
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			-->
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
				<i class="brand"></i>
					<a href="<?php echo site_url(); ?>" class="navbar-brand">
						<small>
							<?php echo config_item('app_name'); ?>
						</small>
					</a>
					<?php
						if ($this->authentication->is_logged_in()) {
					?>	
						<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
							<span class="sr-only">Toggle user menu</span>
							<img src="<?php echo image_url('avatar.png');?>" alt="Jason's Photo" />
						</button>
						<?php 
						if($this->authentication->get_menu_privilege() != '')
						{
						?>
						<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".sidebar">
							<span class="sr-only">Toggle sidebar</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<?php
						}
						?>
						
					<?php
						} else {
					?>
						<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
							<span class="sr-only">Toggle sidebar</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<?php	
						}
					?>
					
				</div>
			
				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<?php
						if ($this->authentication->is_logged_in()) {
					?>
					<ul class="nav ace-nav">
						<li class="light-red user-min">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo image_url('avatar.png');?>" alt="<?php echo $this->authentication->get_user_real_name(); ?>'s Photo" />
								<span class="user-info">
									<small>Selamat Datang, </small>
									<?php echo $this->authentication->get_user_real_name(); ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<?php
									$res_group_user = $this->authentication->any_user_group_exist();
									if( !is_null($res_group_user) ){
								?>
										<li class="active"><a href="#"><i class="ace-icon fa fa-group"></i> Ganti group akses</a></li>
								<?php
											foreach( $res_group_user as $group ){
												if(get_user_group() == $group['id_group']){
													?><li><a href="<?php echo site_url(array('d'=> 'auth','c' => 'Auth', 'm' => 'change_group', 'id_group' => $group['id_group']));?>" class="blue"><span class="fa fa-check-square-o"></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $group['name_group'];?></a></li><?php
												} else {
													?><li><a href="<?php echo site_url(array('d'=> 'auth','c' => 'Auth', 'm' => 'change_group', 'id_group' => $group['id_group'])) ;?>" class=""><span class="fa fa-square-o"></span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $group['name_group'];?></a></li><?php
												}
											}
								?>
										<li class="divider"></li>
								<?php
									}
								?>
								<li>
									<a href="<?php echo site_url(array('d'=> 'auth','c' => 'Auth', 'm' => 'change_password'));?>"><i class="ace-icon fa fa-cog"></i> &nbsp;Ganti Password</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo site_url(array('d'=> 'auth', 'c' => 'Auth', 'm' => 'logout'));?>"><i class="ace-icon fa fa-power-off"></i> &nbsp;Logout</a>
								</li>
							</ul>
						</li>
					</ul>
					<?php
						} else if( $this->authentication->is_logged_in( FALSE ) ) {
					?>
						<ul class="nav ace-nav">
							<li class="light-blue user-min">
								<a data-toggle="dropdown" href="#" class="dropdown-toggle">
									<img class="nav-user-photo" src="<?php echo image_url('avatar.png');?>" alt="<?php echo $this->authentication->get_user_real_name(); ?>'s Photo" />
									<span class="user-info">
										<small>Selamat Datang, </small>
										<?php echo $this->authentication->get_user_real_name(); ?>
									</span>

									<i class="ace-icon fa fa-caret-down"></i>
								</a>
				
								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<li>
										<a href="<?php echo site_url(array('c' => 'Auth', 'm' => 'send_again'));?>"><i class="ace-icon fa fa-cog"></i> &nbsp;Aktifasi Member</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="<?php echo site_url(array('c' => 'Auth', 'm' => 'logout'));?>"><i class="ace-icon fa fa-power-off"></i> &nbsp;Logout</a>
									</li>
								</ul>
							</li>
						</ul>
					<?php
						}
					?>
				</div>
				
				<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="<?php echo site_url(array('d' => 'documentation', 'c' => 'Documentation'));?>">
								<i class="ace-icon fa fa-comments-o"></i>
								Dokumentasi
							</a>
						</li>
						<!--
						<li>
							<a href="">
								<i class="ace-icon fa fa-comments-o"></i>
								FAQ's
							</a>
						</li>
						-->
					</ul>
					<!--
					<form class="navbar-form navbar-left form-search" role="search">
						<div class="form-group">
							<input placeholder="Pencarian Singkat FAQ" type="text" class="width-100">
						</div>

						<button type="button" class="btn btn-xs btn-info2">
							<i class="ace-icon fa fa-search icon-only bigger-110"></i>
						</button>
					</form>
					-->
				</nav><!-- --> 
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
		<!--
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
		-->

			<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse">
				<!--
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
				-->

				<?php echo $this->authentication->render_menu('ace'); ?><!-- /.nav-list -->
				<!--
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
				-->
				<!--
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
				-->
			</div>
			
			
			<div class="main-content">
				<div class="breadcrumbs breadcrumbs-fixed no-margin hidden-sm hidden-xs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>
					<ul class="breadcrumb">
						<?php 
							if( !empty( $template['breadcrumbs'] ) ){
								$total_breadcrumbs = count( $template['breadcrumbs'] );
								$count_breadcrumbs = 1;
								foreach($template['breadcrumbs'] as $breadcrumbs){
									if( $count_breadcrumbs == $total_breadcrumbs ){
										echo '<li class="active">';
										if($breadcrumbs['icon'] != ''){
											echo '<i class="'. $breadcrumbs['icon'] .' blue"></i>&nbsp;';
										}
										echo $breadcrumbs['name'];
									} else {
										echo '<li>';
										if($breadcrumbs['icon'] != ''){
											echo '<i class="'. $breadcrumbs['icon'] .' blue"></i>&nbsp;';
										} else {
											if($count_breadcrumbs == 1){
												echo '<i class="ace-icon fa fa-home home-icon blue"></i>&nbsp;';
											}
										}
										echo '<a href="'. site_url($breadcrumbs['uri']) .'">'. $breadcrumbs['name'] .'</a>';
									}
									
											
									echo '</li>';
									$count_breadcrumbs++;
								}
							} else {
						?>
								<li>
									<i class="ace-icon fa fa-link link-icon blue"></i>
									<a href="<?php echo site_url(); ?>"><?php echo config_item('app_name'); ?></a>
								</li>
						<?php
							}
						?>
						<!--
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" type="text">
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div>
						-->
					</ul>
				</div>
				<div class="page-content">
				<!--
					<div class="ace-settings-container" id="ace-settings-container">
						<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
							<i class="ace-icon fa fa-cog bigger-150"></i>
						</div>

						<div class="ace-settings-box clearfix" id="ace-settings-box">
							<div class="pull-left width-50">
								<div class="ace-settings-item">
									<div class="pull-left">
										<select id="skin-colorpicker" class="hide">
											<option data-skin="no-skin" value="#1B59A6">#1B59A6</option>
											<option data-skin="skin-2" value="#C6487E">#C6487E</option>
											<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
										</select>
									</div>
									<span>&nbsp; Choose Skin</span>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
									<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
									<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
									<label class="lbl" for="ace-settings-add-container">
										Inside
										<b>.container</b>
									</label>
								</div>
							</div><!-- /.pull-left -->
							
							<!--
							<div class="pull-left width-50">
								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
									<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
									<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
								</div>

								<div class="ace-settings-item">
									<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
									<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
								</div>
							</div> 
							/.pull-left 
							-->
						<!--
						</div><!-- /.ace-settings-box -->
					<!--</div><!-- /.ace-settings-container -->
					<?php echo $template['body']; ?>
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->
			<!--
			<div class="footer hidden-sm hidden-xs">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="">
							<span class="blue bolder"></span> &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="" target="_blank">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>
			-->
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<!-- inline scripts related to this page -->
	</body>
</html>
