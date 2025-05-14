<?php
class REL_WP_CLI extends WP_CLI_Command
{
    public function generate_dummy_data($args, $assoc_args)
    {
        require_once REL_PLUGIN_DIR . 'vendor/autoload.php';
        $faker = Faker\Factory::create();

        $cities = array('los-angeles', 'new-york', 'chicago', 'miami');
        $statuses = array('for-sale', 'sold', 'pending');

        for ($i = 0; $i < 1000; $i++) {
            $post_id = wp_insert_post(array(
                'post_title' => $faker->sentence(4),
                'post_content' => $faker->paragraph(3),
                'post_type' => 'property',
                'post_status' => 'publish',
            ));

            if (is_wp_error($post_id)) {
                WP_CLI::error("Failed to create post $i");
                continue;
            }

            update_post_meta($post_id, '_rel_price', $faker->numberBetween(100000, 2000000));
            update_post_meta($post_id, '_rel_location', $faker->address);
            update_post_meta($post_id, '_rel_square_feet', $faker->numberBetween(500, 5000));

            wp_set_object_terms($post_id, $faker->randomElement($cities), 'city');
            wp_set_object_terms($post_id, $faker->randomElement($statuses), 'listing_status');

            $image_id = $this->generate_dummy_image();
            if ($image_id) {
                set_post_thumbnail($post_id, $image_id);
            }

            WP_CLI::log("Created property $i");
        }

        WP_CLI::success('Generated 1000 dummy properties.');
    }

    private function generate_dummy_image() {
        $upload_dir = wp_upload_dir();
        $image_url = 'https://picsum.photos/800/600'; // Use picsum.photos instead
        $image_name = 'property-' . uniqid() . '.jpg';

        $response = wp_remote_get( $image_url );
        if ( is_wp_error( $response ) ) {
            WP_CLI::warning( 'Failed to fetch image: ' . $response->get_error_message() );
            return false;
        }

        $image_data = wp_remote_retrieve_body( $response );
        $file_path = $upload_dir['path'] . '/' . $image_name;

        file_put_contents( $file_path, $image_data );

        $attachment = array(
            'post_mime_type' => 'image/jpeg',
            'post_title' => sanitize_file_name( $image_name ),
            'post_content' => '',
            'post_status' => 'inherit',
        );

        $attach_id = wp_insert_attachment( $attachment, $file_path );
        require_once ABSPATH . 'wp-admin/includes/image.php';
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );
        wp_update_attachment_metadata( $attach_id, $attach_data );

        return $attach_id;
    }
}

WP_CLI::add_command('rel_generate', 'REL_WP_CLI');
