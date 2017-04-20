MONKEY( 'Utils', function(Utils, _, $) {

	Utils.now = function() {
		return ( new Date() ).getTime();
	};

	Utils.getDateToSQL = function(date) {
	    var data = date.split( '/' );
	    return data[2] + '-' + data[1] + '-' + data[0];
	};

	Utils.getUrlAjax = function() {
		return ( window.SiteGlobalVars || {} ).urlAjax;
	};

	Utils.getUrlTemplate = function() {
		return ( window.SiteGlobalVars || {} ).urlTemplate;
	};

	Utils.getUrlArchiveProduct = function() {
		return ( window.SiteGlobalVars || {} ).urlArchiveProduct;
	};

	Utils.getUrlCommerce = function() {
		return ( window.SiteGlobalVars || {} ).urlAjaxCommerce;
	};

	Utils.getUrlEmbed = function(url) {
		var base = ( window.SiteGlobalVars || {} ).urlEmbed;

		return base + '?url=' + url;
	};

	Utils.setArray = function(items) {
		return $.isArray( items ) ? items : [items];
	};

	Utils.decode = function(text) {
		return decodeURIComponent( text );
	};

	Utils.getArgs = function(args) {
		return [].slice.call( args );
	};

	Utils.html = function(html) {
		return $( html.replace( /(\r\n|\n|\r)/gm, '' ) );
	};

	Utils.addQueryVars = function(params, url) {
		var listParams = [];

		for ( var item in params ) {
			listParams.push( item + '=' + params[ item ] );
		}

		return url + ( url.match(/\/\?/) ? '&' : '?' ) + listParams.join( '&' );
	};

	Utils.debounce = function(func, wait, immediate) {
		var timeout, args, context, timestamp, result;

		var later = function() {
			var last = Utils.now() - timestamp;

			if (last < wait && last >= 0) {
				timeout = setTimeout(later, wait - last);
			} else {
				timeout = null;
				if (!immediate) {
					result = func.apply(context, args);
					if (!timeout) {
						context = args = null;
					}
				}
			}
		};

		return function() {
			context = this;
			args = arguments;
			timestamp = Utils.now();
			var callNow = immediate && !timeout;
			if (!timeout) {
				timeout = setTimeout(later, wait);
			}

			if (callNow) {
				result = func.apply(context, args);
				context = args = null;
			}

			return result;
		};
	};

}, MONKEY.utils );