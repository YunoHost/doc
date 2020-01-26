# Yunohost for decentralised grassroot movements

## Introduction

Grassroot movements often start naturally with an event or group of people who do something, but then suddenly grows as more people start to operate around a common cause under the same name. These movements will often organise themselves in local chapters without central authority. More often than not the online tools used by these groups are tools they don't control themselves. There are several reasons why this can be problematic. Sensitive content often falls in the hands of big American enterprises and sometimes the platforms they use and organise on are part of the same problems they rebel against. Smaller local chapters often don't have enough resources or knowledge to host their own services or find alternatives, so one solution is for IT'ers from one or more local chapters to work together and set up services for the movement. This means that the tools are now controlled by the movement, but it also means a lot of work for the IT group while introducing centralisation in a decentralised organisation. Yunohost can help alleviate some of these problems by giving more power to the local chapters and relieve the IT'ers from a big part of the workload.

## How

Yunohost has a couple of restrictions, but also strengths. Yunohost allows for easy administration through a web interface so that even non-sysadmins can do the typical things like administrating users, installing applications, creating backups etc. One restriction of Yunohost is that applications need to run on the same server to get the full potential of Yunohost and that trust between admins and users is implied. On one hand this means that Yunohost doesn't scale very well if you want to host for hundreds of users. On the other hand, Yunohost can be perfect for smaller local chapters where size isn't an issue (yet). We still need a central IT group that has more knowledge to set everything up, teaches good practices and helps in case of problems, but a lot can be delegated to the local chapters in this way.

## Example set up

Let's say that we have a movement called SomeAwesomeMovement. Some IT'ers have decided to buy the domain someawesomemovement.org in order to provide a website, e-mail and maybe some other services. Time goes by and the organisation is growing in numbers. More local chapters pop up and we want to allow them to have more control over their own infrastructure. We look for a local chapter that wants to be a guinea pig for our new set up using Yunohost and it turns out that the local chapter from Paris wants to try this out. The following can now happen:
* A Yunohost server is set-up
  * This can be a VPS with a trusted provider or a server in a location the movement or local chapter controls or trusts.
  * This will probably be done by the IT group but the local chapter is free to do the set up themselves as well.
  * The local chapter needs to have at least one trusted member who can have admin access. If the server is set up by the IT people, they should know who this person is. This person gets the admin password and should change the password after they received it.
  * One or more system users can be created for the IT group and made sudo member so that they can access the server over SSH in case of problems. These problems can be technical, but also social like the only admin suddenly leaving and no one else having access any more. This implies that there needs to be trust between the local chapter and the IT group.
* The DNS records of someawesomemovement.org are changed so that the subdomains paris.someawesomemovement.org and *.paris.someawesomemovement.org point to the new server. The DKIM and other relevant records are also added.
  * Since the domain is under control of the IT group, they will have to set up the DNS records.
  * Example DNS record entries are provided by Yunohost.
  * If the local chapter wants to use their own domain, they can do that as well

Now the local chapter can start creating user accounts for its active members and they can choose what applications to run. Backups can also be seen as a responsibility for the local chapter as well as keeping an eye on resources used by the server and keeping the server up-to-date. Only in case of real problems will the IT people need to step in.

## Services

By default the local chapter has their own email under the paris.someawesomemovement.org domain
* Each user has their own mail address and can create as much aliases as they want/need
* General email addresses to the chapter can be set up, e.g. contact@paris.someawesomemovement.org
  * If more users need to get these mails, a separate user can be created and mail forwards can be set up
* if a mail address paris@someawesomemovement.org already exists, the IT group can forward it to contact@paris.someawesomemovement.org. The local chapter can then choose who should get these mails by changing the alias or setting up a new forward. There is no need for the IT group to do this kind of maintenance work any more.
* The local chapter can set up a web interface and use encrypted email with Roundcube

The members also have XMPP accounts. They can use these to communicate with each other and thanks to the federated nature of XMPP they can also chat with people from other chapters. Jappix can be set up as a webclient. Alternatively, they can also use Matrix by installing Synapse and Riot.

There are also several possibilities to have a website on Yunohost (e.g. by using Drupal or Wordpress). The local chapter can even choose to make the website their default landing page and can still access their Yunohost account using paris.someawesomemovement.org/yunohost/sso. If this link is too hard to remember, it's trivial to set a redirect using the redirect app (e.g. from paris.someawesomemovement.org/account or account.paris.someawesomemovement.org).

Other services that can typically be used are Loomio or Discourse as a Forum, Etherpad for collaborative writing, Nextcloud for cloud storage, Peertube for video's, Plume or Writefreely for blogs... An advantage of some of these services is that they are federated which means that contact with other chapters, or even the whole world, is still trivially possible.

## Costs

Depending on the size of the chapter and how active they are, the cost can be around €3/month for a local chapter. If a lot of storage is needed for e.g. documents or videos, bigger storage will be required, which implies higher costs.

##Conclusion

There are still limitations with this set-up. Local chapters are assumed to remain below a certain number of active members and trust between the IT group, local admins and users is always necessary. Besides that the IT group still has some important responsibilities. They will set up servers and DNS records, need to know who the contact person in the local chapter is, they need to explain the responsibilities to the admins of the local chapters and bring awareness around good practices and security. In case of problems they are still the first line that the local admins can contact and they are typically the ones who file and upstream issues and fixes for problems they see or encounter. A lot of administration however is taken out of their hands, which means that they can focus more on other things. The biggest advantage is of course that local chapters can set up and control their own services now. There is rarely a one-size-fits-all solution that really works for everyone, but one strength of decentralisation is that you don't need a one-size-fits-all solution.
