---
title: RSS-Bridge
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_rss-bridge'
---

[![Installer RSS-Bridge with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=rss-bridge) [![Integration level](https://dash.yunohost.org/integration/rss-bridge.svg)](https://dash.yunohost.org/appci/app/rss-bridge)

*RSS-Bridge* is a PHP project capable of generating RSS and Atom feeds for websites that don't have one. It can be used on webservers or as a stand-alone application in CLI mode.

Important: RSS-Bridge is not a feed reader or feed aggregator, but a tool to generate feeds that are consumed by feed readers and feed aggregators. Find a list of feed aggregators on Wikipedia.

#### Supported sites/pages (main)

 * `FlickrExplore` : [Latest interesting images](http://www.flickr.com/explore) from Flickr
 * `GoogleSearch` : Most recent results from Google Search
 * `GooglePlus` : Most recent posts of user timeline
 * `Twitter` : Return keyword/hashtag search or user timeline
 * `Identi.ca` : Identica user timeline (Should be compatible with other Pump.io instances)
 * `YouTube` : YouTube user channel, playlist or search
 * `Cryptome` : Returns the most recent documents from [Cryptome.org](http://cryptome.org/)
 * `DansTonChat`: Most recent quotes from [danstonchat.com](http://danstonchat.com/)
 * `DuckDuckGo`: Most recent results from [DuckDuckGo.com](https://duckduckgo.com/)
 * `Instagram`: Most recent photos from an Instagram user
 * `OpenClassrooms`: Lastest tutorials from [fr.openclassrooms.com](http://fr.openclassrooms.com/)
 * `Pinterest`: Most recent photos from user or search
 * `ScmbBridge`: Newest stories from [secouchermoinsbete.fr](http://secouchermoinsbete.fr/)
 * `Wikipedia`: highlighted articles from [Wikipedia](https://wikipedia.org/) in English, German, French or Esperanto
 * `Bandcamp` : Returns last release from [bandcamp](https://bandcamp.com/) for a tag
 * `ThePirateBay` : Returns the newest indexed torrents from [The Pirate Bay](https://thepiratebay.se/) with keywords
 * `Facebook` : Returns the latest posts on a page or profile on [Facebook](https://facebook.com/)

Plus [many other bridges](bridges/) to enable, thanks to the community

#### Output format

Output format can take several forms:

 * `Atom` : ATOM Feed, for use in RSS/Feed readers
 * `Mrss` : MRSS Feed, for use in RSS/Feed readers
 * `Json` : Json, for consumption by other applications.
 * `Html` : Simple html page.
 * `Plaintext` : raw text (php object, as returned by print_r)

### Screenshots

![Screenshots of RSS-Bridge](https://github.com/YunoHost-Apps/rss-bridge_ynh/blob/master/doc/screenshots/screenshot_rss-bridge_welcome.png)

### Disclaimers / important information

### Configuration

#### Enabling/Disabling bridges

By default, the script creates `whitelist.txt` and adds the main bridges (see above). you can edit it:

 * to enable extra bridges (one bridge per line)
 * to disable main bridges (remove the line)
 * to enable all bridges (just one wildcard `*` as file content)

As a matter  of simplicity, this YunoHost package enables every bridge by default.

## Useful links

+ Website: [github.com/RSS-Bridge/rss-bridge](https://github.com/RSS-Bridge/rss-bridge)
+ Demonstration: [Demo](https://wtf.roflcopter.fr/rss-bridge/)
+ Application software repository: [github.com - YunoHost-Apps/rss-bridge](https://github.com/YunoHost-Apps/rss-bridge_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/rss-bridge/issues](https://github.com/YunoHost-Apps/rss-bridge_ynh/issues)
