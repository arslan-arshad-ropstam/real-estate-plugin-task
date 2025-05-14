<?php
class Real_Estate_Listings
{
    public function init()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post_property', array($this, 'save_meta'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('rel-tailwind', REL_PLUGIN_URL . 'assets/css/tailwind.min.css', array(), '1.0.0');
    }

    public function admin_scripts()
    {
        wp_enqueue_script('rel-admin', REL_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), '1.0.0', true);
    }

    public function add_meta_boxes()
    {
        add_meta_box(
            'rel_property_details',
            'Property Details',
            array($this, 'render_meta_box'),
            'property',
            'normal',
            'high'
        );
    }

    public function render_meta_box($post)
    {
        wp_nonce_field('rel_save_property', 'rel_nonce');
        $price = get_post_meta($post->ID, '_rel_price', true);
        $location = get_post_meta($post->ID, '_rel_location', true);
        $square_feet = get_post_meta($post->ID, '_rel_square_feet', true);
?>
        <p>
            <label for="rel_price">Price:</label><br>
            <input type="number" id="rel_price" name="rel_price" value="<?php echo esc_attr($price); ?>" style="width:100%;">
        </p>
        <p>
            <label for="rel_location">Location:</label><br>
            <input type="text" id="rel_location" name="rel_location" value="<?php echo esc_attr($location); ?>" style="width:100%;">
        </p>
        <p>
            <label for="rel_square_feet">Square Feet:</label><br>
            <input type="number" id="rel_square_feet" name="rel_square_feet" value="<?php echo esc_attr($square_feet); ?>" style="width:100%;">
        </p>
<?php
    }

    public function save_meta($post_id)
    {
        if (! isset($_POST['rel_nonce']) || ! wp_verify_nonce($_POST['rel_nonce'], 'rel_save_property')) {
            return;
        }

        if (isset($_POST['rel_price'])) {
            update_post_meta($post_id, '_rel_price', sanitize_text_field($_POST['rel_price']));
        }
        if (isset($_POST['rel_location'])) {
            update_post_meta($post_id, '_rel_location', sanitize_text_field($_POST['rel_location']));
        }
        if (isset($_POST['rel_square_feet'])) {
            update_post_meta($post_id, '_rel_square_feet', sanitize_text_field($_POST['rel_square_feet']));
        }
    }
}
