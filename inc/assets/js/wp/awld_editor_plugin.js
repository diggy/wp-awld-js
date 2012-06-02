(
	function(){	
		var icon_url = '../wp-content/plugins/wp-awld-js/inc/assets/images/wp_awld_js_icon.png';	
		tinymce.create(
			"tinymce.plugins.AwldShortcodes",
			{
				init: function(d,e) {},
				createControl:function(d,e)
				{				
					if(d=="wp_awld_js_shortcodes_button")
					{					
						d=e.createMenuButton( "wp_awld_js_shortcodes_button",{
							title:"Awld.js Shortcodes",
							image:icon_url,
							icons:false
							});							
							var a=this;d.onRenderMenu.add(function(c,b)
							{						
								a.addImmediate(b,"Link", '[awld href=""][/awld]');								
								b.addSeparator();								
								a.addImmediate(b,"Person", '[awld type="person" href=""][/awld]');
								a.addImmediate(b,"Object", '[awld type="object" href=""][/awld]');
								b.addSeparator();								
								a.addImmediate(b,"Index", '[awld_index]');
							});
						return d					
					}					
					return null
				},		
				addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}})}				
			}
		);		
		tinymce.PluginManager.add( "AwldShortcodes", tinymce.plugins.AwldShortcodes);
	}
)();