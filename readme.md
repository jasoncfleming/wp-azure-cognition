=== Azure Alt AI ===
Contributors: Josh Fields & Thiago Teixeira
Requires at least: 4.8
Tested up to: 4.9.5
Stable tag: 1.0.0

Add Accessibility functions to Wordpress Sites

== Description ==
This plugins uses Microsoft Azure Cognitive Services to automatically add alt text to images, both for new uploads and in bulk for old images. It also allows for dictation by Azure's Bing 

== Installation ==
Install it like any other plugin, no special actions required.
1. Upload `ms-accessibility-tools` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Ready to use. To configure - go to the Accessibility Tools section

== Common Problem ==

If using Azure Web Apps, be sure to not use relative URLs in your wp-config.php file.

== Changelog ==
= 1.0.0 =
* Forked from MS Accessibility Tools to use new Azure Vision API format. Removed translation services.
