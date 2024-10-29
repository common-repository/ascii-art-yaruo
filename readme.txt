=== Ascii Art Yaruo ===
Contributors: tgkzkzk
Donate link: https://tgk.zkzk.org/
Tags: short code
Requires at least: 3.3
Tested up to: 5.2.2
Stable Tag: 1.0.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Yaruo (やる夫) is ascii art character of 2ch.
This plugin is short code for display yaruo of text.

== Description ==

[Example page](http://tgk.zkzk.org/wordpress-aayaruo)

### TEXTAREA
[aa_mode version="1"]

[aa name="yaruo_01" id="2"]

or

[aa_panel name="yaruo_01" id="1" class="aa_words"]

speak speak

[/aa_panel]

[/aa_mode]


#### AA image and id list is in
* plugins/aayaruo/txt_1/yaruo_01/_list.html
* plugins/aayaruo/txt_1/yaruo_02/_list.html
* plugins/aayaruo/txt_1/yaranaio_01/_list.html
* plugins/aayaruo/txt_1/yaranaio_02/_list.html

### short code parameter

#### aa_mode
* **version:** [1]
Version of ascii art txt directory.
(txt_1)

#### aa
* **name:** [yaruo_01|yaruo_02|yaranaio_02|yaranaio_02]
* **id:** [0-9+] image number

#### aa_panel
* **name:** [yaruo_01|yaruo_02|yaranaio_02|yaranaio_02]
* **id:** [0-9+] image number
* **class:** [aa_words|words_aa]
* **padding:** [100|200|300|400|500|600] left margin

aa_words: AA Image on the left, words on the right.

words_aa: Words on the left, AA image on the right.

== Installation ==

1. Upload plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently asked questions ==

### How to make AA image
plugins/aayaruo/mlt2txt.pl is AA image file converter.

AA file site
[Yaruyomi](http://aa.yaruyomi.com/)

== Screenshots ==

1. Display Yaruo and Yaranaio.


== Changelog ==

1.

== Upgrade Notice ==

1.
