# Real Estate Listings Plugin

A WordPress plugin designed to manage and display real estate listings with a high-performance, responsive frontend and a robust admin interface. The plugin provides a custom post type for properties, taxonomies for filtering, a shortcode for dynamic displays, custom templates for single and archive pages, and a WP-CLI command to generate dummy data for testing.


## Features
- **Custom Post Type**: `property` for real estate listings with support for title, description, featured image, price, location, city, square feet, and listing status.
- **Taxonomies**:
  - `city` (hierarchical) for filtering by city (e.g., Los Angeles, New York).
  - `listing_status` (non-hierarchical) for statuses like For Sale, Sold, Pending.
- **Shortcode**: `[property_listings city="xxx" status="xxx"]` to display filtered listings in a responsive grid.
- **Custom Templates**:
  - Single property page (`single-property.php`) for detailed listing views.
  - Archive page (`archive-property.php`) for listing archives and taxonomy filters.
- **Admin Meta Boxes**: Manage property details (price, location, square feet) via the WordPress admin.
- **WP-CLI Command**: ` wp rel_generate generate_dummy_data --path=/var/www/html` to create 1000 dummy listings with fake data (requires FakerPHP).
- **Responsive Styling**: Uses TailwindCSS for a clean, mobile-friendly frontend.
- **Performance**: Optimized WP_Query, minimal CSS, and efficient database interactions.

## Prerequisites
- **WordPress**: Version 5.8 or higher.
- **PHP**: Version 7.4 or higher.
- **Node.js and npm**: For compiling TailwindCSS (Node.js v20.13.1+, npm v10.5.2+ recommended).
- **Composer**: For installing FakerPHP for WP-CLI dummy data generation.
- **WP-CLI**: For running the ` wp rel_generate generate_dummy_data --path=/var/www/html ` command (optional but required for dummy data).
- **Server Access**: SSH or terminal access to install dependencies and run WP-CLI (may require hosting provider support in restricted environments like `jailshell`).
- **Write Permissions**: For `wp-content/uploads` (image uploads) and plugin directory (template/CSS files).

## Installation
1. **Download the Plugin**:
   - Clone the repository or download the ZIP file:
     ```bash
     git clone https://github.com/arslan-arshad-ropstam/real-estate-plugin-task.git
     ```
   - Or upload the `real-estate-listings` folder to `/wp-content/plugins/`.

2. **Activate the Plugin**:
   - In the WordPress admin, go to **Plugins > Installed Plugins**.
   - Activate **Real Estate Listings**.

## Setup
1. **Configure Permalinks**:
   - Go to **Settings > Permalinks** in the WordPress admin and click “Save Changes” to register the `property` post type and taxonomies.

2. **Verify Templates**:
   - Ensure the following files exist in `real-estate-listings/templates/`:
     - `single-property.php`
     - `archive-property.php`
     - `property-card.php`

3. **Add Placeholder Image** (Optional):
   - To avoid issues with external services like `picsum.photos`, add a local placeholder image:
     - Place an 800x600 image (e.g., `placeholder.jpg`) in `real-estate-listings/assets/images/`.
     - Ensure `class-wp-cli.php` uses the local image (see WP-CLI section).

## Using the Plugin

### Shortcode
Display property listings on any page or post using the `[property_listings]` shortcode.

- **Basic Usage**:
  ```shortcode
  [property_listings]

  ## Video Tutorials

To help you get started, we’ve created two video tutorials:

- **Plugin Front Flow Overview**: Demonstrates the user experience, including the `[property_listings]` shortcode, single property pages, archive pages, and taxonomy filters.
  - Watch: [[YouTube-Front-Flow-URL](https://youtu.be/EzzsUhQ1GT8)]

- **Code Overview**: Walks through the plugin’s codebase, covering the custom post type, taxonomies, WP-CLI script, TailwindCSS integration, and template structure.
  - Watch: [[YouTube-Code-Overview-URL](https://youtu.be/COL5SWc1Jf8)]

*Replace `[https://youtu.be/EzzsUhQ1GT8]` and `[https://youtu.be/COL5SWc1Jf8]` with actual YouTube video links.*