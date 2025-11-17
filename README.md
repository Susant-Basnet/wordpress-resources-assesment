# Resources

A small, no-nonsense WordPress plugin (built for an assessment) that registers a **Resources** custom post type and provides a `[latest_resources]` shortcode to display latest items in a responsive grid.

This is intentionally lightweight and easy to extend.

---

## Features

- Custom Post Type: **Resources**
- Supports Title, Content, Excerpt (short description), and Featured Image
- Shortcode: `[latest_resources limit="5"]` (change `limit` to show more/less)
- CSS Grid based, responsive layout
- Enqueues styles properly and escapes all output

---

## Installation

1. Upload the `Resources` folder to `/wp-content/plugins/`
2. Activate the plugin from the **Plugins** screen in WordPress
3. Add resources via **Resources → Add New**
4. Use the shortcode on any page or post:
   ```
   [latest_resources limit="5"]
   ```

---

## Usage Notes

- The plugin is intentionally simple: you can add custom fields (PDF, link, categories) easily.
- The stylesheet is minimal — feel free to override in your theme or add a settings screen to toggle styles.

---

## Author

**Susant Basnet**  
WordPress Developer – Thanka Digital Pvt. Ltd.  
https://thanka.digital

--- 
## Changelog

### 1.0.0
- Initial release: CPT + shortcode + basic styling
