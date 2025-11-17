# Latest Resources

This is a small custom plugin built for a WordPress Developer assessment.  
It registers a **Resources** custom post type and provides a shortcode `[latest_resources limit="5"]` to show the latest resources in a grid layout.

---

## 🧩 What it does
- Adds a **Resources** section in the WordPress admin.
- Supports **Title**, **Featured Image**, **Excerpt**, and **Content**.
- Shortcode: `[latest_resources limit="5"]`
- Displays a responsive grid of the latest resources.

---

## ⚙️ How to Install
1. Download the ZIP or clone this repo.
2. Upload the `latest-resources` folder to your `wp-content/plugins/` directory.
3. Activate the plugin from **Plugins → Installed Plugins**.
4. You’ll now see **Resources** in your WordPress sidebar.

---

## 💡 How to Use
1. Go to **Resources → Add New**.
2. Add title, short description, and a featured image.
3. On any page or post, use the shortcode:
   ```plaintext
   [latest_resources limit="5"]
