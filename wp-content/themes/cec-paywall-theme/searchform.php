<?php
/**
 * Custom search form template
 *
 * @package CEC_Paywall_Theme
 */
?>

<form role="search" method="get" class="search-form flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="sr-only">
        <?php echo esc_html_x( 'Search for:', 'label', 'cec-paywall-theme' ); ?>
    </label>
    <div class="relative flex-grow">
        <input type="search" class="search-field w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'cec-paywall-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </div>
    <button type="submit" class="search-submit bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md transition-colors">
        <?php echo esc_html_x( 'Search', 'submit button', 'cec-paywall-theme' ); ?>
    </button>
</form>