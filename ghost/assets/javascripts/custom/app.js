jQuery( ".hamburger-wrapper" ).on('click', function(){
	jQuery( this ).toggleClass( "active" );
	jQuery( "#header" ).toggleClass( "active-menu" )
});
