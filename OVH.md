#DNS Configuration with OVH

Let's see how to properly set the DNS redirections with [OVH](http://www.ovh.com).

Once you bought your domain name, got to the Web Control Panel, and click on you domain name on the left side:

<img src="/images/ovh_control_panel.png" width=800>

Click on the **DNS Zone** tab, then on **Add an entry**:

<img src="/images/ovh_dns_zone.png" width=800>

Now you need to add the DNS redirections as specified by the [standard DNS zone configuration](/dns_config)


###Dynamic IP

[General tutorial on dynamic IP](dns_dynamicip).

You should follow this part if you have a dynamic IP.

Find out if your ISP provides you with a dynamic IP adress [here](/isp).

Let's create a DynHost id.

Follow [this tutorial](http://blog.developpez.com/brutus/p6316/ubuntu/configurer_dynhost_ovh_avec_ddclient) to install ddclient.
ddclient will take care of telling OVH that the IP has changed. Then OVH will update the IP.

You need to add in the configuration file :
* your login and password DynHost
* your domain name

You should also check out [OVH's guide on DynHost](https://www.ovh.co.uk/g2024.hosting_dynhost).
