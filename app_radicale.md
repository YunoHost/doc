# Radicale

Radical is a calendar and contact server CalDAV/CardDAV. It does not have a graphical administration interface.

Radical is installed by default with the web client InfCloud that will view and edit your calendars and address books.

To connect another client to radical, we must inform these addresses:

### Complete CalDAV/CardDAV collection of a user
- URL: https://domain.tld/path/user/
- Exemple : https://example.org/radicale/me/

### To connect a calendar in particular
- URL: https://domain.tld/path/user/calendar.ics/
- Exemple: https://example.org/radicale/me/calendar.ics/

### To connect an address book in particular
- URL: https://domain.tld/path/user/AddressBook.vcf/
- Exemple: https://example.org/radicale/me/AddressBook.vcf/

### Create a new schedule or a new address book
Create a new schedule or a new address book is very simple with radical, just go there! Radical create all new calendar or notebook to nonexistent addresses if you try to access it.

So just log on (as before) to a calendar or a nonexistent address book to create it.
This can be done simply with a browser, to appear in a collection already connected to a client.

### Go to a calendar or an address book of another user
Previous addresses also work to access resources not owned by the authenticated user.

> Example:
> User1 can connect to the collection of user2
> https://example.org/radicale/user2/
> Simply to indicate the login and password of user1.
> It's sharing rules (see below) that will allow or not to user1 to see the contents of the collection of user2.
> By default, no sharing is allowed.

---

### Configure the access rights and sharing of calendars and address books
By default, any user has the right to read and write on its own calendars and address books.
It is possible to refine these default rules and to allow sharing by allowing users to access their resources do not own.
The rules governing these rights should be included in the */etc/radicale/rights*

Each rule is in this form:
```bash
# Comment before rule and explaining that (optional of course):
[Rule Name]
user: user concerned
collection: calendar, book or collection concerned.
permission: permission, r (read), w (write) or rw (read/write)
```
*Rights* file contains several examples that can be exploited.
To validate changes to the */etc/radicale/rights* file, radical must be recharged via uwsgi service.
```bash
sudo service uwsgi restart
```

### Share resources
To share a calendar or address book, just write a rule permitting. Sharing can be done with another user.
```bash
user: ^user1$
collection: ^user2/shared2.ics$
permission: rw
```
Or publicly for a remote user does not use the same server.
```bash
user: .*
collection: ^user2/shared2.ics$
permission: r
```
In both cases, the sharing works only using the full address of the calendar or collection. In other words, the shares do not appear in the collection of a user.
This limitation may be blocking for clients managing a single collection, as InfCloud. In this particular case, a solution overcomes this problem.

#### Share resources directly in the collection of a user
> This solution is functional, but is an hack ...

To enable sharing to occur directly in the collection of a user, it must exploit the use of files in Radicale.
By simply creating a symbolic link to the resource sharing.
```bash
ln -sr user2/shared.ics user1/user2_shared.ics
```
The shared resource becomes a resource from the collection of user1, while it physically remains in the collection of user2.
However, without recourse to the rules for each resource in the collection of user1, the general rule applies. user1 gets so read and write access by default on the shared resource because it is part of his collection.

---

### Making Radical log more verbose
By default, the Radical log is set to INFO. This method savings the hard drive but does not debug Radicale in case of problems.
To pass Radicale in DEBUG mode, edit the */etc/radicale/logging* and change INFO to DEBUG in sections *[logger_root]* and *[handler_file]*. Then reload the uwsgi service.
Now, the log displays all requests that are made to Radicale and analysis of *rights* file.
However, do not stay on this mode because the log is filled very quickly.

---

### Change config of InfCloud
The configuration of InfCloud is in the *infcloud/config.js* file
To load any changes in the *config.js* file (or other file of InfCloud) must reload the cache with the script provided.
```bash
sudo ./cache_update.sh
```

----------------------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="APPLICATION's logo"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

- [Configuration](#Configuration)
- [Limitations with YunoHost](#limitations-with-yunohost)
- [Customer Applications](#Customer-applications)
- [Useful links](#useful-links)

**General presentation of the application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**If the configuration of the application is not done with the admin panel of YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations with YunoHost

**Explanation of the current limitations in using the application with YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Customer applications

| Application name | Platform | Multi-account | Other supported networks | Play Store | F-Droid | Apple Store | *Other* |
|------------------|----------|---------------|--------------------------|------------|---------|-------------|---------|
|                  |          |               |                          |            |         |             |         |

## Useful links

+ Website: [WEBSITE](#)
+ Official documentation: [DOCUMENTATION](#)
+ Application software repository: [github.com - YunoHost-Apps/APPLICATION](https://github.com/YunoHost-Apps/APPLICATION_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/APPLICATION/issues](https://github.com/YunoHost-Apps/APPLICATION_ynh/issues)
