=== WP Prism Syntax Highlighter ===
Contributors: GuiTeK
Tags: prism, prismjs, syntax, highlighter, highlight, highlighting, wp
Tested up to: 4.0
Stable tag: 1.0.5
License: The MIT License
License URI: http://opensource.org/licenses/mit-license.php

A lightweight and convenient plugin to integrate Prism Syntax Highlighter into WordPress.

== Description ==
*WP Prism Syntax Highlighter* enables you to use [Prism](http://prismjs.com) by [Lea Verou](http://lea.verou.me) in your WordPress blog.
> Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind.

* It has an easy and convenient **code editor** integrated into the WordPress editor toolbar: you can insert code in just one click.
* It requires **no configuration** at all, however you can still customize the default settings in the plugin's settings page.

It supports *all* Prism features, namely:

* Syntax highlighting (30+ languages)
* Custom themes (6 official themes)
* Plugins (7 official plugins: [Line Highlight](http://prismjs.com/plugins/line-highlight), [Line Numbers](http://prismjs.com/plugins/line-numbers), [Show Invisibles](http://prismjs.com/plugins/show-invisibles), [Autolinker](http://prismjs.com/plugins/autolinker), [WebPlatform Docs](http://prismjs.com/plugins/wpd), [File Highlight](http://prismjs.com/plugins/file-highlight), [Show Language](http://prismjs.com/plugins/show-language))

**NOTE: the plugin archive contains**

* ***all* languages definitions**
* ***no* plugin**
* ***default* theme**

It is recommended to use **only what you need** in order to keep the plugin the smallest possible.
Please download your custom Prism from http://prismjs.com/download.html and upload the files in:

* your_plugin_directory/wp-prism-syntax-highlighter/css/
* your_plugin_directory/wp-prism-syntax-highlighter/js/
**Do NOT replace the original prism.css and prism.js, you will lose all your changes as they get overwritten when updating the plugin!**


**Help**  
Wondering how to install the plugin? Visit the *Installation* page.
Want to see the plugin in action? Click *Screenshot* above.
Got any question? See the *FAQ*.

**Contribute**  
Both Prism and this plugin are distributed under the MIT license and are developed during our free time. Any help, even a bug report, is much appreciated!
To contribute:

* Prism: https://github.com/LeaVerou/prism
* Plugin: https://github.com/GuiTeK/wp-prism-syntax-highlighter

**Why another Prism plugin?**  
If you searched the plugin directory, you certainly noticed that there are several Prism plugins for WordPress. Well, none of them satisfied me: one plugin had no code editor, the other didn't escape HTML tags, another didn't have the options I needed... so I made a new one to suit my needs.

== Installation ==
1. Download the plugin archive from https://wordpress.org/plugins/wp-prism-syntax-highlighter and unzip it
2. Upload the wp-prism-syntax-highlighter folder to your plugin directory (usually wp-content/plugins)
3. Activate the plugin (*Plugins* > *Installed Plugins*)
4. If you get a warning from the plugin asking you to edit your theme, please do it as you might experience visual bugs (requires about 30 seconds of your time)
5. Highlight some code!

== Frequently Asked Questions ==
**Q:** how can I install WP Prism Syntax Highlighter?  
**A:** please see the *Installation* page.

**Q:** what is the warning I get when I enable WP Prism Syntax Highlighter?  
**A:** some themes (like the *Twenty* ones included into WordPress by default) already include some CSS to prettify code blocks. It might interfere with Prism and you might experience visual bugs. That's why it's recommended to comment out or remove any CSS code related to pre or code tags.

**Q:** how do I disable line wrap?  
**A:** by default Prism does NOT wrap lines. It's certainly your theme's fault (*Twenty* themes are known to do that). Search for line like `word-wrap: break-word;` and comment it out.

**Q:** what to do if I encouter a bug?  
**A:** please [open an issue](https://github.com/GuiTeK/wp-prism-syntax-highlighter/issues). However, make sure the bug is related to the plugin itself and not to Prism. If you think it's a Prism bug, please open an issue [here](https://github.com/LeaVerou/prism/issues).

== Screenshots ==
1. Integrated code editor
2. Highlighted C++ code
3. Plugin settings

== Changelog ==
= 1.0.5 =
+ Added custom settings for Prism CSS and JavaScript files, allowing the user to use its own version and thus preventing it from being overwritten when updating the plugin
* Fixed HTML escaping
* The editor plugin now adds a space after inline code, allowing the user to step out of the <code> tag
* Updated default Prism to the latest version
* Updated WordPress version to 4.0

= 1.0.4 =
* Updated license

= 1.0.3 =
* Updated readme.txt

= 1.0.2 =
* Updated readme.txt

= 1.0.1 =
* Updated readme.txt

= 1.0.0 =
* Initial release

== Upgrade Notice ==
This is pretty obvious. Upgrade to get rid of bugs and get all new features!
