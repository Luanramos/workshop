MONKEY.Wrapper( 'MONKEY.AjaxWrapper', function(namespace, callback) {

	MONKEY( 'Ajax.' + namespace, function(Model, utils, $) {

		Model.fn.initialize = function() {
			this.emitter();
			this.init.apply( this, utils.getArgs( arguments ) );
		};

		Model.fn.emitter = function() {
			var emitter = $({});
			this.on     = $.proxy( emitter, 'on' );
			this.fire   = $.proxy( emitter, 'trigger' );
		};

		Model.fn.request = function(id, params, options) {
			var defaults = {
				url      : utils.getUrlAjax(),
				type     : 'GET',
				dataType : 'json',
				data     : params || {}
			};

			var ajax = $.ajax( $.extend( defaults, options ) );

			ajax.done( $.proxy( this, '_done', id ) );
			ajax.fail( $.proxy( this, '_fail', id ) );
		};

		Model.fn._done = function(id, response) {
			this.fire( 'done' + id, [ response ] );
		};

		Model.fn._fail = function(id, throwError, status) {
			this.fire( 'fail' + id, [ throwError.responseJSON, status ] );
		};

		Model.fn.init = function() {

		};

		callback( Model, utils, $ );

	});

});