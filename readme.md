=== Azure Alt AI ===

* Contributors: Josh Fields & Thiago Teixeira
* Requires at least: 4.8
* Tested up to: 4.9.8
* Stable tag: 1.0.0

== Description ==

This plugins uses Microsoft Azure Vision API to automatically add alt text to images, both for new uploads and in bulk for old images. It also allows for dictation by Azure's Bing Speech API if a key is input.

== Installation ==

Install it like any other plugin, no special actions required.
1. Upload `wp-azure-cognition` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Ready to use. To configure - go to the Azure AI section

== Common Problems ==

If using Azure Web Apps, be sure to not use relative URLs in your wp-config.php file.

== Changelog ==

= 1.0.0 =
* Forked from MS Accessibility Tools to use new Azure Vision API format.
* Added ability to change confidence intervals & API endpoints.
* Removed translation services.
* Uploading the "large" picture to Azure instead of the full size to avoid 4MB cap.
