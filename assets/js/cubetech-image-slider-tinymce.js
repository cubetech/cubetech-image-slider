tinymce.create( 
	'tinymce.plugins.cubetech_image_slider', 
	{
	    /**
	     * @param tinymce.Editor editor
	     * @param string url
	     */
	    init : function( editor, url ) {
			/**
			*  register a new button
			*/
			editor.addButton(
				'cubetech_image_slider_button', 
				{
					cmd   : 'cubetech_image_slider_button_cmd',
					title : editor.getLang( 'cubetech_image_slider.buttonTitle', 'cubetech Image Carousel' ),
					image : url + '/../img/toolbar-icon.png'
				}
			);
			/**
			* and a new command
			*/
			editor.addCommand(
				'cubetech_image_slider_button_cmd',
				function() {
					/**
					* @param Object Popup settings
					* @param Object Arguments to pass to the Popup
					*/
					editor.windowManager.open(
						{
							// this is the ID of the popups parent element
							id       : 'cubetech_image_slider_dialog',
							width    : 480,
							title    : editor.getLang( 'cubetech_image_slider.popupTitle', 'cubetech Image Carousel' ),
							height   : 'auto',
							wpDialog : true,
							display  : 'block',
						},
						{
							plugin_url : url
						}
					);
				}
			);
		}
	}
);

// register plugin
tinymce.PluginManager.add( 'cubetech_image_slider', tinymce.plugins.cubetech_image_slider );