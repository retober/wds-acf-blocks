<?php
/**
 * BLOCK - Quotes
 *
 * @link https://developer.wordpress.org/block-editor/
 *
 * @package abs
 */

use function WebDevStudios\abs\get_acf_fields;
use function WebDevStudios\abs\get_block_classes;
use function WebDevStudios\abs\get_formatted_args;
use function WebDevStudios\abs\get_formatted_atts;
use function WebDevStudios\abs\print_element;
$abs_defaults = [
	'class'               => [ 'wds-block', 'wds-block-quotes' ],
	'allowed_innerblocks' => [ 'core/heading', 'core/paragraph' ],
	'id'                  => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
	'fields'              => [], // Fields passed via the print_block() function.
];

// Parse the $args if we're rendering this with print_block() from a theme.
if ( ! empty( $args ) ) :
	$abs_defaults = get_formatted_args( $args, $abs_defaults );
endif;

// Get custom classes for the block and/or for block colors.
$abs_block_classes = isset( $block ) ? get_block_classes( $block ) : [];

if ( ! empty( $abs_block_classes ) ) :
	$abs_defaults['class'] = array_merge( $abs_defaults['class'], $abs_block_classes );
endif;

// Set up element attributes.
$abs_atts = get_formatted_atts( [ 'class', 'id' ], $abs_defaults );

// Pull in the fields from ACF, if we've not pulled them in using print_block().
$abs_quotes = ! empty( $abs_defaults['fields'] ) ? $abs_defaults['fields'] : get_acf_fields( [ 'quotes' ], $block['id'] );

?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<figure>
		<img
			src="<?php echo esc_url( get_theme_file_uri( 'build/images/block-previews/quotes-preview.jpg' ) ); ?>"
			alt="<?php esc_html_e( 'Preview of the Quotes Block', 'abs' ); ?>"
		>
	</figure>
<?php elseif ( $abs_quotes['quotes'] ) : ?>
	<section <?php echo $abs_atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		if ( ! empty( $abs_defaults['allowed_innerblocks'] ) ) :
			echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $abs_defaults['allowed_innerblocks'] ) ) . '" />';
		endif;
		?>
		<?php foreach ( $abs_quotes['quotes'] as $abs_quote ) : ?>
			<div class="quote">
				<?php
				print_element(
					'blockquote',
					[
						'quote' => $abs_quote['quote'],
						'cite'  => $abs_quote['cite'],
						'class' => [ 'block-content' ],
					]
				);
				?>
			</div>
		<?php endforeach; ?>
	</section>
<?php endif; ?>
