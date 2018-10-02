<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="Shortcut Icon" href="https://static.zeo.im/wp-content/uploads/2017/05/2017052002575074.ico" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE;chrome=1">
<link href="https://static.zeo.im/uikit.min.css" rel="stylesheet">
<link href="https://static.zeo.im/uikit-rtl.min.css" rel="stylesheet">
<script src="https://static.zeo.im/uikit-icons.min.js"></script>
<script src="https://static.zeo.im/uikit.min.js"></script>

<?php wp_head(); ?>
</head>
<body <?php body_class( suxingme_bodyclass() ); ?>>
    
<div class="intro-bg animations-fadeInUp-post" style="background-color:#fff !important;display:none;" id="open_post"></div>

<div id="header" class=" navbar-fixed-top" style="<?php if(is_mobile() && is_single()){echo "display:none";}elseif($is_home){echo"padding-top: 20px;
    padding-bottom: 10px;box-shadow:none !important;";} ?>">
	<div class="container">
		<h1 class="logo" style="<?php if($is_home && is_mobile()){echo"height: 66px;line-height: 66px;padding-top: 15px;";} //else echo "display:none;"; ?>">
			<a  href="https://www.zeo.im" title="Zeo小半" style="<?php if($is_home){echo"width: 150px;
    height: 45px;";} ?>;background-image: url(<?php if( suxingme('suxingme_logo') ) { echo suxingme('suxingme_logo'); }else{
				echo get_template_directory_uri() . '/img/logo.png'; }?>);"/>
            <img src="https://static.ouorz.com/hat.svg" style="position:  relative;left: 65px;top: -70px;height: 15px;width: 30px;
">
			</a>
		</h1>
		<?php
			if(!wp_is_mobile()):
		?>
		<div role="navigation"  class="site-nav  primary-menu">
			<div class="menu-fix-box">
				 <?php if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('top-nav') ) {
					wp_nav_menu(
								array(
										'theme_location'   => 'top-nav',
										'sort_column'	   => 'menu_order',

										'fallback_cb' => 'cmp_nav_fallback',
										'container' => false,
										'menu_id' =>'menu-navigation',
										'menu_class' =>'menu',
									)
							);
				?>
				 <?php } else { ?>
					<ul id="menu-navigation" class="menu">
					<li>这里是菜单</li>
					</ul><!-- topnav end -->
				<?php } ?>
			</div>
		</div>
		<?php endif; ?>
		<div class="right-nav" style="<?php if($is_home && is_mobile()){echo"top: 0px;
    right: 10px;
    color: #333;
    padding-top: 10px;
    font-size: 39px;
    padding-right: 34px;"; }else echo "display:none;"; ?>">
		    <a href="https://www.zeo.im/zeoweekly"><i class="icon-book-1"></i></a>
		</div>

		<?php
			if(wp_is_mobile()):
		?>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              	<span class="icon-bar"></span>
              	<span class="icon-bar"></span>
              	<span class="icon-bar"></span>
            </button>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
		            <?php if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('mobile-nav') ) { wp_nav_menu(
						array(
								'theme_location'   => 'mobile-nav',
								'depth'           => 2,
								'fallback_cb' => 'cmp_nav_fallback',
								'container' => false,
								'items_wrap' => '%3$s',
								'menu_class' =>'menu',
							)
						);
					?>
					<?php } else { ?>
						<li><a href="#">这里是菜单</a></li>
					<?php } ?>
			    </ul>
			</div>
			<div class="body-overlay"></div>
   		<?php endif; ?>
	</div>
</div>