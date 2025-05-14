<?php
class REL_Shortcode
{
    public function init()
    {
        add_shortcode('property_listings', array($this, 'render_shortcode'));
    }

    public function render_shortcode($atts)
    {
        $atts = shortcode_atts(array(
            'city' => '',
            'type' => '',
            'status' => '',
        ), $atts);

        $args = array(
            'post_type' => 'property',
            'posts_per_page' => 12,
            'post_status' => 'publish',
        );

        if (! empty($atts['city'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'city',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['city']),
            );
        }

        if (! empty($atts['status'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'listing_status',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['status']),
            );
        }

        $query = new WP_Query($args);
        ob_start();
?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    include REL_PLUGIN_DIR . 'templates/property-card.php';
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No properties found.</p>';
            endif;
            ?>
        </div>
<?php
        return ob_get_clean();
    }
}
