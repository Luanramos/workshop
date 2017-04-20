MONKEY.ComponentWrapper( 'Check', function(Check) {

	Check.fn.init = function() {
		this.$el.iCheck( this.attr || {} );
	};

});
