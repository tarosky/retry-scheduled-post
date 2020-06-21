=== Retry Scheduled Post ===
Contributors: tarosky, ko31
Donate link: https://tarosky.co.jp
Tags: future, future posts, scheduled posts, scheduled, posts
Requires at least: 4.5
Tested up to: 5.4.2
Stable tag: 1.1.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

If the future scheduled post failed to publish, this plugin will republish it.

== Description ==

If the future scheduled post failed to publish, this plugin will republish it.

If you set up a retry schedule from the configuration screen, it will be run periodically by wp-cron.

= WP-CLI =

You can also run the retry process from the wp-cli command.

```
$ wp retry-scheduled-post
```

== Installation ==

1. Upload `retry-scheduled-post` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. “Dashboard” -> ”Settings” -> ”Retry Scheduled Post"

== Changelog ==

= 1.1.0 =
* Add cli command.
* Add enable setting.

= 1.0.0 =
* First release.
