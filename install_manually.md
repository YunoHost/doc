# Installing YunoHost manually

Once you have access to a command line on your server (either directly or through SSH), you can install yunohost by running command as root :

```bash
bash <(wget -q -O- https://install.yunohost.org/)
```

<small>*(If `wget` is not installed on your system, you might need to install it with `apt install wget`)*</small>

Once the installation is finished, you may want to [**proceed to post-installation**](/postinstall)

---

**Note for advanced users concerned with the `curl|bash` approach**

If you strongly object to the `curl|bash` way (and similar commands) of installing software, consider reading ["Is curl|bash insecure?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) on Sandstom's blog, and possibly [this discussion on Hacker News](https://news.ycombinator.com/item?id=12766350).

