# Diagnose YunoHost functioning

If you have successfully [installed](/install) YunoHost and passed through the [post-installation](/postinstall), you probably have a **working server**.

### <small>1.</small> Test it

In a web browser, access to your server via the domain name you just entered at the post-installation step.

For example: `http://mydomain.com`


<div class="alert alert-warning">
If you have taken a <b>.nohost.me</b> or a <b>.noho.st</b> domain, you may have to wait 5 min before the address is reachable.
</div>

---

#### If that does not work...

---

### <small>2.</small> Have you configured your DNS well ?

<div class="alert alert-info">
This step is not necessary if you have a <b>.nohost.me</b> or a <b>.noho.st</b> domain
</div>

Go to https://www.whatsmydns.net/ , enter your domain name in the field and click `Search`.    
If you do not see your IP address, or if there are red crosses everywhere, then you have probably misconfigured your [DNS](/dns).

---

### <small>3.</small> Are network ports opened on your router ?

If your DNS is properly configured, and your server is accessible locally, you may have **network ports blocked** or it may not be forwarded by your router.    
In order to verify this, try accessing your server with a client outside your local network. For example via another WiFi access point or with your mobile phone in 3G/4G.

If the server is unreachable from outside your local network too, then the problem probably comes from your router's configuration.

<div class="alert alert-info">
Try to activate uPnP in your router's configuration interface, and check that your server is plugged in Ethernet directly behind it.
<p>
You can also redirect ports manually to your server's local IP address on the router's configuration interface.
</p>
</div>

---

### <small>4.</small> Does your router have hairpinning ?

If the server is accessible from outside your local network, but unreachable with its domain name on the local network, then your router probably lacks <a href="https://en.wikipedia.org/wiki/Hairpinning" target="_blank">hairpinning</a>.

Here is a [tutorial](dns_local_network) to access your server on a local network and bypass the hairpinning problem. The tutorial proposes a first solution to create a redirection with DNS of the ISP box and a second solution to modify the `hosts` file of the **clients** to instruct it to access the **server** via its local IP address. The first solution is preferable because it's not necessary to modify the `hosts` files on every computer  on your local network, if you are using many different clients.
