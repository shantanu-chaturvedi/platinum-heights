/*
 * jquery.urlive.js v1.1.1, jQuery URLive
 *
 * Copyright 2014 Mark Serbol.   
 * Use, reproduction, distribution, and modification of this code is subject to the terms and 
 * conditions of the MIT license, available at http://www.opensource.org/licenses/MIT.
 *
 * https://github.com/markserbol/urlive
 *
 */

;(function($){
	var defaults = {
		container: '.urlive-container',
		target: '_blank',
		imageSize: 'auto',
		render: true,
		disableClick: false,
		regexp: /((https?:\/\/)?[\w-@]+(\.[a-z]+)+\.?(:\d+)?(\/\S*)?)/i,
		yqlSelect: '*',
		callbacks: {
			onStart: function() {},
			onSuccess: function() {}
		}
	},
	
	xajax = (function(ajax){		
		var exRegex = RegExp(window.location.protocol + '//' + window.location.hostname),
			yql_base_uri = 'http'+(/^https/.test(window.location.protocol)?'s':'') + 
			               '://query.yahooapis.com/v1/public/yql?callback=?',
			yql_query = 'select {SELECT} from html where url="{URL}" and xpath="*" and compat="html5"';
		
		return function(o) {		
			var url = (!/^https?:\/\//i.test(o.url)) ? window.location.protocol + '//' + o.url : o.url;	
          
			if (/get/i.test(o.type) && !/json/i.test(o.dataType) && !exRegex.test(url) && /:\/\//.test(url)){			
			
				o.url = yql_base_uri;
				o.dataType = 'json';			
				o.data = {
					q: yql_query.replace('{SELECT}', o.yqlSelect).replace(
						'{URL}',
						url + (o.data ? (/\?/.test(url) ? '&' : '?') + $.param(o.data) : '')
					),
					format: 'xml'
				};

				if (!o.success && o.complete) {
					o.success = o.complete;
					delete o.complete;
				}
				
				o.success = (function(success){
					return function(data){						
						if(success){							
							success.call(this, {
								responseText: (data.results[0] || '').replace(/<script[^>]+?\/>|<script(.|\s)*?\/script>/gi, '')
							}, 'success');
						}
							
					};
				})(o.success);
					
			}		
			return ajax.apply(this, arguments);				
		};
		
	})($.ajax),	
	
	methods = {
		init: function(options){
			var opts = $.extend(true, defaults, options);
			
			return this.each(function(){
				var el = $(this), url = undefined;
				
				el.data('urlive-container', opts.container);
								
				if(el.is('a')){
					url = el.attr('href');
				}else{
					var text = el.val() || el.text(), 
						regexp = opts.regexp, 
						email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				
					url = regexp.exec(text);
					
					url = (url && !email.test(url[0])) ? url[0] : null;			
				}
				
				if(url){
					getData(url);
				}
						
				function getData(url){					
					xajax({
						url: url,
						type: 'GET',
						yqlSelect: opts.yqlSelect,
						beforeSend: opts.callbacks.onStart				
					}).done(function(data){
						if(!$.isEmptyObject(data.results)){
							data = data.results[0];
							
							html = $('<div/>',{html:data});
		
							get = function(prop){	
								return html.find('[property="' + prop + '"]').attr('content') 
											 || html.find('[name="' + prop + '"]').attr('content') 
											 || html.find(prop).html() || html.find(prop).attr('src');
							};
											
							set = {
								image: el.data('image') || get('og:image') || get('img'), 
								title: el.data('title') || get('og:title') || get('title'), 
								description: el.data('description') || get('og:description') || get('description'),
								url: el.data('url') || get('og:url') || url,	
								type: el.data('type') || get('og:type'),				
								sitename: el.data('site_name') || get('og:site_name')
							};
							//console.log(set);
						}
					});			
				}
				
			});
		}
		
	};
	
	$.fn.urlive = function(method){
		if(methods[method]){
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		}else if(typeof method === 'object' || !method){
			return methods.init.apply(this, arguments);
		}
	};
	
})(jQuery);