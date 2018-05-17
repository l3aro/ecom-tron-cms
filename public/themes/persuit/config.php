<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Inherit from another theme
	|--------------------------------------------------------------------------
	|
	| Set up inherit from another if the file is not exists, this 
	| is work with "layouts", "partials", "views" and "widgets"
	|
	| [Notice] assets cannot inherit.
	|
	*/

	'inherit' => null, //default

	/*
	|--------------------------------------------------------------------------
	| Listener from events
	|--------------------------------------------------------------------------
	|
	| You can hook a theme when event fired on activities this is cool 
	| feature to set up a title, meta, default styles and scripts.
	|
	| [Notice] these event can be override by package config.
	|
	*/

	'events' => array(

		'before' => function($theme)
		{
			$theme->setAuthor('Blackheart');
		},

		'asset' => function($asset)
		{
			$asset->themePath()->add([
			// CSS
				// Icon css link
				['font-awesome', 'css/font-awesome.min.css'],
				['line-icon', 'vendors/line-icon/css/simple-line-icons.css'],
				['elegant-icon', 'vendors/elegant-icon/style.css'],
				// Bootstrap
				['bootstrap', 'css/bootstrap.min.css'],
				// Rev slider css 
				['revolution-settings', 'vendors/revolution/css/settings.css'],
				['revolution-layers', 'vendors/revolution/css/layers.css'],
				['revolution-nav', 'vendors/revolution/css/navigation.css'],
				// Extra plugin css
				['owl-carousel', 'vendors/owl-carousel/owl.carousel.min.css'],
				['bootstrap-selector', 'vendors/bootstrap-selector/css/bootstrap-select.min.css'],
				['jquery-ui', 'vendors/jquery-ui/jquery-ui.css'],
				// Custom css
				['style', 'css/style.css'],
				['responsive', 'css/responsive.css'],										
			// JS
				// jQuery (necessary for Bootstrap's JavaScript plugins)
				['jquery', 'js/jquery-3.2.1.min.js'],
				// Include all compiled plugins (below), or include individual files as needed
				['popper', 'js/popper.min.js'],
				['bootstrap', 'js/bootstrap.min.js'],
				// Rev slider js
				['revolution-tools', 'vendors/revolution/js/jquery.themepunch.tools.min.js'],
				['revolution-themepunch', 'vendors/revolution/js/jquery.themepunch.revolution.min.js'],
				['revolution-actions', 'vendors/revolution/js/extensions/revolution.extension.actions.min.js'],
				['revolution-video', 'vendors/revolution/js/extensions/revolution.extension.video.min.js'],
				['revolution-slideanims', 'vendors/revolution/js/extensions/revolution.extension.slideanims.min.js'],
				['revolution-layeranimation', 'vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js'],
				['revolution-navigation', 'vendors/revolution/js/extensions/revolution.extension.navigation.min.js'],
				// Extra plugin js
				['counterup-waypoints', 'vendors/counterup/jquery.waypoints.min.js'],
				['counterup-waypoints', 'vendors/counterup/jquery.counterup.min.js'],
				['owl-carousel', 'vendors/owl-carousel/owl.carousel.min.js'],
				['bootstrap-selector', 'vendors/bootstrap-selector/js/bootstrap-select.min.js'],
				['image-dropdown', 'vendors/image-dropdown/jquery.dd.min.js'],
				['smoothscroll', 'js/smoothscroll.js'],
				['imagesloaded', 'vendors/isotope/imagesloaded.pkgd.min.js'],
				['isotope', 'vendors/isotope/isotope.pkgd.min.js'],
				['magnify-popup', 'vendors/magnify-popup/jquery.magnific-popup.min.js'],
				['vertical-slider', 'vendors/vertical-slider/js/jQuery.verticalCarousel.js'],
				['jquery-ui', 'vendors/jquery-ui/jquery-ui.js'],
				// Custom js
				['scripts', 'js/theme.js'],			
			]);
		},


		'beforeRenderTheme' => function($theme)
		{
			// To render partial composer
			/*
	        $theme->partialComposer('header', function($view){
	            $view->with('auth', Auth::user());
	        });
			*/

		},

		'beforeRenderLayout' => array(

			'mobile' => function($theme)
			{
				// $theme->asset()->themePath()->add('ipad', 'css/layouts/ipad.css');
			}

		)

	)

);