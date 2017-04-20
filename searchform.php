<?php 
// Avoid that files are directly loaded
if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

use Apiki\Theme\Utils;
?>

<form data-component-validation-forms role="search" method="get" class="search-form" action="<?php echo esc_url( Utils::get_site_url() ); ?>">
	<label>
		<input type="search" class="search-field" placeholder="Digite aqui para buscar:" value="<?php the_search_query(); ?>" name="s" title="Pesquisar por:" required />
	</label>
	<input type="submit" class="search-submit btn-secondary" value="Pesquisar">
</form>