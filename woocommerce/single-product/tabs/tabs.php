<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php foreach ( $tabs as $key => $tab ) : ?>
                <?php 
                    $activetab = '';
                    $selected = 'false';
                    if(esc_attr($key) == 'description'){
                        $activetab = 'active';
                        $selected = 'true';
                    }
                ?>
				<li class="nav-item" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a class="nav-link <?php echo $activetab; ?>" id="<?php echo esc_attr( $key ); ?>-tab" data-toggle="tab" href="#" role="tab" aria-controls="<?php echo esc_attr( $key ); ?>" aria-selected="<?php echo $selected; ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php foreach ( $tabs as $key => $tab ) : ?>
                <?php 
                    $show = '';
                    if(esc_attr($key) == 'description'){
                        $show = 'show active';
                    }
                ?>
                <div class="tab-pane fade <?php echo $show != ''? $show: ''; ?>" id="<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $key ); ?>-tab">
                    <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                </div>
            <?php endforeach; ?>
        </div>
	</div>

<?php endif; ?>
