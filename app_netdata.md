## NetData

[NetData](http://my-netdata.io/) is a system for **distributed real-time performance and health monitoring**.
It provides **unparalleled insights, in real-time**, of everything happening on the
system it runs (including applications such as web and database servers), using
**modern interactive web dashboards**.

_netdata is **fast** and **efficient**, designed to permanently run on all systems
(**physical** & **virtual** servers, **containers**, **IoT** devices), without
disrupting their core function._

[![Install Piwigo with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=piwigo)

**Customization brought by the package:**

* grant MySQL statistics access via a `netdata` user
* nginx root log statistics via putting `netdata` user in the `adm` group
* Dovecot statistics via giving access to Dovecot stats stocket to `netdata` user (works only with Dovecot 2.2.16+)

**Further recommendations:**
We don't allow YunoHost packages to make sensible changes to system files. So here are further customizations you can make to allow more monitoring:

* Nginx: 
  * requests/connections: follow [these recommandations](https://github.com/firehol/netdata/tree/master/python.d#nginx) to enable `/stab_status` (for example by putting the `location` section in `/etc/nginx/conf.d/yunohost_admin.conf`
  * weblogs: you can monitor all your nginx weblogs for errors; follow [these recommendations](https://github.com/firehol/netdata/tree/master/python.d#nginx_log)
* phpfpm: follow [these recommandations](https://github.com/firehol/netdata/tree/master/python.d#phpfpm)

## Features

<p align="center">
<img src="https://cloud.githubusercontent.com/assets/2662304/19168687/f6a567be-8c19-11e6-8561-ce8d589e8346.gif"/>
</p>

 - **Stunning interactive bootstrap dashboards**<br/>
   mouse and touch friendly, in 2 themes: dark, light

 - **Amazingly fast**<br/>
   responds to all queries in less than 0.5 ms per metric,
   even on low-end hardware

 - **Highly efficient**<br/>
   collects thousands of metrics per server per second,
   with just 1% CPU utilization of a single core, a few MB of RAM and no disk I/O at all

 - **Sophisticated alarming**<br/>
   hundreds of alarms, **out of the box**!<br/>
   supports dynamic thresholds, hysteresis, alarm templates,
   multiple role-based notification methods (such as email, slack.com,
   pushover.net, pushbullet.com, telegram.org, twilio.com, messagebird.com)

 - **Extensible**<br/>
   you can monitor anything you can get a metric for,
   using its Plugin API (anything can be a netdata plugin,
   BASH, python, perl, node.js, java, Go, ruby, etc)

 - **Embeddable**<br/>
   it can run anywhere a Linux kernel runs (even IoT)
   and its charts can be embedded on your web pages too

 - **Customizable**<br/>
   custom dashboards can be built using simple HTML (no javascript necessary)

 - **Zero configuration**<br/>
   auto-detects everything, it can collect up to 5000 metrics
   per server out of the box

 - **Zero dependencies**<br/>
   it is even its own web server, for its static web files and its web API

 - **Zero maintenance**<br/>
   you just run it, it does the rest

 - **scales to infinity**<br/>
   requiring minimal central resources

 - **several operating modes**<br/>
   autonomous host monitoring, headless data collector, forwarding proxy, store and forward proxy, central multi-host monitoring, in all possible configurations.
   Each node may have different metrics retention policy and run with or without health monitoring.

 - **time-series back-ends supported**<br/>
   can archive its metrics on `graphite`, `opentsdb`, `prometheus`, json document DBs, in the same or lower detail
   (lower: to prevent it from congesting these servers due to the amount of data collected)

![netdata](https://cloud.githubusercontent.com/assets/2662304/14092712/93b039ea-f551-11e5-822c-beadbf2b2a2e.gif)

---

## What does it monitor?

netdata collects several thousands of metrics per device.
All these metrics are collected and visualized in real-time.

> _Almost all metrics are auto-detected, without any configuration._

This is a list of what it currently monitors:

- **CPU**<br/>
  usage, interrupts, softirqs, frequency, total and per core, CPU states

- **Memory**<br/>
  RAM, swap and kernel memory usage, KSM (Kernel Samepage Merging), NUMA

- **Disks**<br/>
  per disk: I/O, operations, backlog, utilization, space, software RAID (md)

   ![sda](https://cloud.githubusercontent.com/assets/2662304/14093195/c882bbf4-f554-11e5-8863-1788d643d2c0.gif)

- **Network interfaces**<br/>
  per interface: bandwidth, packets, errors, drops

   ![dsl0](https://cloud.githubusercontent.com/assets/2662304/14093128/4d566494-f554-11e5-8ee4-5392e0ac51f0.gif)

- **IPv4 networking**<br/>
  bandwidth, packets, errors, fragments,
  tcp: connections, packets, errors, handshake,
  udp: packets, errors,
  broadcast: bandwidth, packets,
  multicast: bandwidth, packets

- **IPv6 networking**<br/>
  bandwidth, packets, errors, fragments, ECT,
  udp: packets, errors,
  udplite: packets, errors,
  broadcast: bandwidth,
  multicast: bandwidth, packets,
  icmp: messages, errors, echos, router, neighbor, MLDv2, group membership,
  break down by type

- **Interprocess Communication - IPC**<br/>
  such as semaphores and semaphores arrays

- **netfilter / iptables Linux firewall**<br/>
  connections, connection tracker events, errors

- **Linux DDoS protection**<br/>
  SYNPROXY metrics

- **fping** latencies</br>
  for any number of hosts, showing latency, packets and packet loss

   ![image](https://cloud.githubusercontent.com/assets/2662304/20464811/9517d2b4-af57-11e6-8361-f6cc57541cd7.png)


- **Processes**<br/>
  running, blocked, forks, active

- **Entropy**<br/>
  random numbers pool, using in cryptography

- **NFS file servers and clients**<br/>
  NFS v2, v3, v4: I/O, cache, read ahead, RPC calls

- **Network QoS**<br/>
  the only tool that visualizes network `tc` classes in realtime

   ![qos-tc-classes](https://cloud.githubusercontent.com/assets/2662304/14093004/68966020-f553-11e5-98fe-ffee2086fafd.gif)

- **Linux Control Groups**<br/>
  containers: systemd, lxc, docker

- **Applications**<br/>
  by grouping the process tree and reporting CPU, memory, disk reads,
  disk writes, swap, threads, pipes, sockets - per group

   ![apps](https://cloud.githubusercontent.com/assets/2662304/14093565/67c4002c-f557-11e5-86bd-0154f5135def.gif)

- **Users and User Groups resource usage**<br/>
  by summarizing the process tree per user and group,
  reporting: CPU, memory, disk reads, disk writes, swap, threads, pipes, sockets

- **Apache and lighttpd web servers**<br/>
   `mod-status` (v2.2, v2.4) and cache log statistics, for multiple servers

- **Nginx web servers**<br/>
  `stub-status`, for multiple servers

- **Tomcat**<br/>
  accesses, threads, free memory, volume

- **web server log files**<br/>
  extracting in real-time, web server performance metrics and applying several health checks

- **mySQL databases**<br/>
  multiple servers, each showing: bandwidth, queries/s, handlers, locks, issues,
  tmp operations, connections, binlog metrics, threads, innodb metrics, and more

- **Postgres databases**<br/>
  multiple servers, each showing: per database statistics (connections, tuples
  read - written - returned, transactions, locks), backend processes, indexes,
  tables, write ahead, background writer and more

- **Redis databases**<br/>
  multiple servers, each showing: operations, hit rate, memory, keys, clients, slaves

- **mongodb**<br/>
  operations, clients, transactions, cursors, connections, asserts, locks, etc

- **memcached databases**<br/>
  multiple servers, each showing: bandwidth, connections, items

- **elasticsearch**<br/>
  search and index performance, latency, timings, cluster statistics, threads statistics, etc

- **ISC Bind name servers**<br/>
  multiple servers, each showing: clients, requests, queries, updates, failures and several per view metrics

- **NSD name servers**<br/>
  queries, zones, protocols, query types, transfers, etc.

- **Postfix email servers**<br/>
  message queue (entries, size)

- **exim email servers**<br/>
  message queue (emails queued)

- **Dovecot** POP3/IMAP servers<br/>

- **ISC dhcpd**<br/>
  pools utilization, leases, etc.

- **IPFS**<br/>
  bandwidth, peers

- **Squid proxy servers**<br/>
  multiple servers, each showing: clients bandwidth and requests, servers bandwidth and requests

- **HAproxy**<br/>
  bandwidth, sessions, backends, etc

- **varnish**<br/>
  threads, sessions, hits, objects, backends, etc

- **OpenVPN**<br/>
  status per tunnel

- **Hardware sensors**<br/>
  `lm_sensors` and `IPMI`: temperature, voltage, fans, power, humidity

- **NUT and APC UPSes**<br/>
  load, charge, battery voltage, temperature, utility metrics, output metrics

- **PHP-FPM**<br/>
  multiple instances, each reporting connections, requests, performance

- **hddtemp**<br/>
  disk temperatures

- **smartd**<br/>
  disk S.M.A.R.T. values

- **SNMP devices**<br/>
  can be monitored too (although you will need to configure these)

- **statsd**<br/>
  [netdata is a fully featured statsd server](https://github.com/firehol/netdata/wiki/statsd)

And you can extend it, by writing plugins that collect data from any source, using any computer language.

## Links

 * Report a bug: https://github.com/YunoHost-Apps/netdata_ynh/issues
 * NetData website: http://my-netdata.io/