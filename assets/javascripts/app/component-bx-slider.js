MONKEY.ComponentWrapper( 'BxSlider', function(BxSlider) {

	BxSlider.fn.init = function() {
		if ( ! this.widthMin || window.innerWidth <= this.widthMin ) {
			this.$el.bxSlider( this.attr || {} );
		}
	};

});
