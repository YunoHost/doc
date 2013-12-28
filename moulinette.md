#CLI



##yunohost

la command de base est yunohost
```bash
usage: yunohost [-h] [-v]

positional arguments:
  {domain,monitor,service,firewall,backup,app,hook,dyndns,user,tools}
    domain              Manage domains
    monitor             Monitor the server
    service             Manage services
    firewall            Manage firewall rules
    backup              Manage backups
    app                 Manage apps
    hook                Manage hooks
    dyndns              Subscribe and Update DynDNS Hosts
    user                Manage users
    tools               Specific tools

optional arguments:
  -h, --help            show this help message and exit
  -v, --version         Display moulinette version
```

### domain
```bash
yunohost domain [-h] {info,add,list,remove}
    info                Get domain informations
    add                 Create a custom domain
    list                List domains
    remove              Delete domains
```

### monitor
```bash
yunohost monitor [-h] {enable,network,show-stats,update-stats,disk,system,disable}
    enable              Enable server monitoring
    network             Monitor network interfaces
    show-stats          Show monitoring statistics
    update-stats        Update monitoring statistics
    disk                Monitor disk space and usage
    system              Monitor system informations and usage
    disable             Disable server monitoring
```

### service
```bash
yunohost service [-h] {status,start,enable,log,stop,disable}
    status              Show status information about one or more services
                        (all by default)
    start               Start one or more services
    enable              Enable one or more services
    log                 Log every log files of a service
    stop                Stop one or more services
    disable             Disable one or more services
```

### firewall
```bash
yunohost firewall [-h]{installupnp,checkupnp,list,stop,disallow,reload,allow,removeupnp}
    installupnp         Add upnp cron
    checkupnp           check if UPNP is install or not (0 yes 1 no)
    list                List all firewall rules
    stop                Stop iptables and ip6tables
    disallow            Disallow connection
    reload              Reload all firewall rules
    allow               Allow connection port/protocol
    removeupnp          Remove upnp cron
```

### backup
```bash
yunohost backup [-h] {init} ...
    init      Init Tahoe-LAFS configuration
```

### app
```bash
yunohost app [-h]
{map,ssowatconf,install,checkport,listlists,removelist,info,upgrade,service,fetchlist,checkurl,list,remove,removeaccess,setting,initdb,addaccess}
    map                 List apps by domain
    ssowatconf          Regenerate SSOwat configuration file
    install             Install apps
    checkport           Check availability of a local port
    listlists           List fetched lists
    removelist          Remove list from the repositories
    info                Get app info
    upgrade             Upgrade app
    service             Add or remove a YunoHost monitored service
    fetchlist           Fetch application list from app server
    checkurl            Check availability of a web path
    list                List apps
    remove              Remove app
    removeaccess        Revoke access right to users (everyone by default)
    setting             Set ou get an app setting value
    initdb              Create database and initialize it with optionnal
                        attached script
    addaccess           Grant access right to users (everyone by default)
```

### hook
```bash
yunohost hook [-h] {callback,add,check,remove,exec} ...
    callback            Execute all scripts binded to an action
    add                 Store hook script to filesystem
    check               Parse the script file and get arguments
    remove              Remove hook scripts from filesystem
    exec                Execute hook from a file with arguments
```

### dyndns
```bash
yunohost dyndns [-h] {subscribe,update,installcron,removecron} ...
    subscribe           Subscribe to a DynDNS service
    update              Update IP on DynDNS platform
    installcron         Install IP update cron
    removecron          Remove IP update cron
```

### user
```bash
yunohost user [-h] {info,create,list,update,delete} ...
    info                Get user informations
    create              Create user
    list                List users
    update              Update user informations
    delete              Delete user
```

### tools
```bash
yunohost tools [-h] {postinstall,maindomain,ldapinit,adminpw} ...
    postinstall         YunoHost post-install
    maindomain          Main domain change tool
    ldapinit            YunoHost LDAP initialization
    adminpw             Change admin password
```
