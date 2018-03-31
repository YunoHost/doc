# YunoHost project organisation

## Document objective

This document aims at allowing contributors to feel legitimate in contributing to the YunoHost project together with collective feedback.
The project is community-based and hasty decisions made by a restricted group of contributors can generate frustrations at a later stage.
To address this issue, the proposed solution here is to ensure that decisions are taken collectively and that they are sufficiently thought out.
An advisory council provides orientations for the evolution of the YunoHost project and special interest groups allow more efficient contribution in relation to each specific topic.

## Definition of YunoHost

###Objectives

The goal of YunoHost is to make accessible to the largest number of people, the installation and administration of a server, without prejudice to the quality and reliability of the software. 

### Values

#### A free and community-based software

YunoHost is a software under free licence, fully community-based and based on applications which are themselves community-based and often free (roundcube, baikal, etc.)

#### That everyone can appropriate

Historically, the project has been very close to initiatives which aim at creating a neutral and decentralised Internet. This proximity especially with the [FFDN](https://www.ffdn.org/), has materialised by having some contributors to create the InternetCu.be whose mission is to facilitate self-hosting by providing a complete solution including a service (via a VPN) and a device. This militant aspect does not inhibit commercial software initiatives hereby companies could propose support or hosting.

## YunoHost organisation

### A theme-based, open structure

The objective of the YunoHost organisation is to allow the largest number of people to contribute to software improvement, whether from a technical point of view (development, application packaging) or otherwise (communication, end-user assistance, documentation, etc.). Inspired by the projects which were reviewed at a recent event (Kodi, Debian, Django, Fedora, Wikipedia, etc.) and by ideas stemming from YunoHost contributors (Jérôme, Bram, opi, scith, ju), a decision was made to organise work by special interest groups, federated thanks to a council to key contributors.

YunoHost project organisation schema

<img src="https://raw.githubusercontent.com/YunoHost/yunohost-project-organization/master/organization_schema.png" height="600px" />

#### Definition and structure of groups

Groups are structured as a result of the fact that YunoHost counts many sub-projects (a total of 13), but without always knowing who is in charge or who is competent. It has therefore been decided to simplify the organisation into sub-projects according to theme-based groups:

- ##### Core Dev Group
 - YunoHost Core
 - Moulinette
 - Web admin
 - SSOwat
 - Dynette
 - YNH-Dev

- ##### Distribution Group
 - Creation and maintenance of installation images on various architectures
 - Distribution of images
 - Management of Debian packages distribution

- ##### Infra/Sysadmin Group
 - Infrastructure
 - Website (wiki, forum, chat room, redmine, mumble)
 - Demo
 - Services
    - [ip.yunohost.org](https://ip.yunohost.org/) and ip6.yunohost.org
    - [yunoports](http://ports.yunohost.org/)
    - nohost.me and noho.st
    - [yunodash](https://dash.yunohost.org/)
    - [yunopaste](http://paste.yunohost.org/)

- ##### Apps Group
 - Official apps
 - Community-based apps
 - App development tools (package_checker, package linter)

- ##### Communication Group
 - Documentation
 - Communication (announcement of project evolutions on the forum, social networks)
 - Translation
 - Mutual assistance (support)

Groups are open to all contributors willing to participate to the development of YunoHost. Everyone can register with the communication channels associated with the group they want to get involved with. Everyone is free to exchange with the rest of the group and to submit a decision point which will follow a prior stage of exchange and improvement of the proposal.
In order to facilitate its management, each group names a coordinator (and a deputy) whose role is:

- to welcome and to federate new regular contributors to the group
- to keep the Council informed of decisions taken within the group (see next point)

The choice of a communication tool is left to each group depending on its relevance (forum, chat, email, etc.)

#### Definition and structure of the Council

YunoHost is growing and it's important to maintain a coherence among all the groups. However, it is impossible to impose on every member within every group to take interest or to get involved in all aspects of the project (due to time and competency constraints). To address this, it has been suggested that a meta-group be created where every group has at least one representative: hence the Council.
The Council is independent of groups and brings together contributors wishing to get involved in the project to the maximum extent. It's role is to:

- take important decisions affecting YunoHost which are dependent on one single group (for instance, changing the wiki engine)
- regularly follow up on the overall aspect of the project to ensure its cohesion (Mumble meeting)
- call on the whole community of contributors (or even end-users) when a decision appears divisive between groups or within the Council

To take part at Council-level votes, you must have contributed to the project and have obtained a right to vote (or right of entry) at the Council. This right is delivered by the Council (and may be upon request). The Council is free at any moment to change its decision process.
To be a member of the Council does not imply that you have access to all resources (infrastructure, repositories, etc.).

### A decision process based on soft consensus

Decisions to be taken can be of 2 kinds:

1. for a group (for example, "to merge a PR" would be assumed by the Dev Group whereas to "post a tweet" would fall under the responsibility of the Communication Group)
2. for the overall project (for instance, to decide on a release with new features) 

If a consensus is not reached over a decision within a particular group, they must refer to the Council for further discussions. If no consensus has been reached, the proposal will be submitted to a vote by all contributors.

#### The decision process in detail

##### 1) Initiating a decision
- can be initiated by anyone following predefined media within each group (e.g. to open a PR automatically triggers this process) 
- necessarily public with the exception of well-defined situations (bug related to a critical security issue or vote relative to individuals)
- an end-date is automatically set for every type of proposition. This date is used for various reasons:
    - to leave enough time for everyone to express themselves and to avoid hasty decisions
    - to maintain a certain rhythm otherwise if the quota of responses is reached then there's no need to wait for everyone's views within a group
       - the quota is evaluated according to people registered in a group (or the Council, depending on the situation) who have expressed their desire to be considered as a regular voter => for instance kload could wish to give their opinion at a particular occasion, but with no intention of applying as a active voting member at the Council 
   - so it can be postponed upon simple request by any one member of the group—and only the group, not all contributors.

##### 2) Opening a discussion with several possible responses:
Anyone can change their position at any moment, but it's expected to let the group react if necessary (e.g. avoid going from positive to negative to reject a proposal altogether after just 3 minutes).

- "simple" replies
   - "I agree" –> counts as a positive view
   - "It seems good to me, but I'd rather abide by others' opinion" –> if there are only such views (or like the next one) and at least one positive view and the due date is past, then the proposal is accepted
   - "no views" / "I'm not in a position to express a helpful view (e.g. I can't code in X)"
   - delayed reponse
   - request for clarification, in which case the decision is suspended
   - refusal: any refusal should be argued and justified

##### 3) Suspension/Postponement
- while there is no response, a decision is considered suspended; at the moment of a response, the end date is automatically postponed (if needed) (for a duration to be determined, which is shorter than the initial time)
- in a situation where there are positive and negative views, or where there is a choice between several proposals

##### 4) Request for modifications
- however, it may happen that discussions take place around these modifications; if such is the case, there is a new decision to be added to the list of existing decisions, and the process applies again (with a postponement of the date)
- if there aren't enough people agreeing, the date is postponed and a recall must be sent
- if the result is very close, the group is invited to rediscuss the matter if it is important, otherwise this could turn into a divisive issue and of tensions in the future

##### 5) Closure
- if the group is unanimous in its decision
   - with agreements only 
   - with refusals only
   - no opinions (relying on others' views)
- For a minor or standard decision, if the quota of responses is reached by the minimal deadline and there's a consensus.
- The quota of responses means necessary views as detailed below according to different types of decisions. The percentage is based on the number of active members in the group. The coordinator and its deputy are in charge of managing active and inactive members in a group, as they maintain an up-to-date list of members at least at every decision point within the group. (An inactive member who shows up for a decision automatically becomes active).
- If it isn't possible to have enough people (vacations, not enough members in a group to provide their views), a group can request closing a vote before the voting quota is reached; there's then a new postponement and if the new postponed date is reached, then the proposal is closed according to recorded views.

###### Micro-decision:
- A decision taken and immediately applied by a single member. This kind of decision must necessarily be reversible, and can be questioned by anyone from any group.

###### Minor decision
- Initial duration: 1 week.
- Minimal duration: 3 days.
- Postponement, if necessary: 3 days.
- Necessary views: 2 members of a group (the person who initiated the decision can express their view); in an anticipated format, 3 of which 2 members of the group.

###### Standard decision:
- Initial duration: 2 weeks.
- Minimal duration: 1 week.
- Postponement, if necessary: 1 week.
- Necessary views: 50% of members of a group (the person who initiated the decision can express their view); in an anticipated format, 66% of members.
- Validation by voting (when applicable): 75% of positive votes.

###### Major decision:
- Initial duration: 1 month.
- Postponement, if necessary: 2 weeks.
- Necessary views: 75% of members of a group (the person who initiated the decision can express their view).
- Validation by voting (when applicable): 90% of positive votes.

##### 6) Application
Then a member of a group can announce their decision as effective (and proceed with necessary actions such as releasing, merging, announcing, etc.). If certain actions are required, it's important that people commit themselves to performing them, since a decision without designated people is of little use

## Composition of groups

- Council : Bram, ju, ljf, Maniack, Moul, opi, theodore
- Core Dev : AlexAubin, Bram, JimboJoe, Ju, ljf, Moul, opi
- Apps : Bram, cyp, frju365, JimboJoe, Josue-T, Ju, ljf, Maniack C, Maxime, Moul, Scith, Tostaki
- Infra : Bram, Ju, Maniack C, Moul, opi
- Communication
  - Com : Bram, Moul, korbak, ljf, opi, frju365
  - Doc : Moul, Theodore
  - Trans : Jean-Baptiste
- Distribution : Heyyounow

## Summary table of the number of views required for a decision 

_Values are rounded (e.g. 5.4 => 5 and 5.5 => 6)._


|                      | **Minor** | **Standard** | **Major** |
|----------------------|---------|----------|---------|
| **Council**              |
|    Standard closure |    2    |     4    |    5    |
|    Anticipated closure |    3*   |     5    |
|    Closure by voting  |    5    |     5    |    6    |
| **Core Dev**             |
|    Standard closure |    2    |     3    |    5    |
|    Anticipated closure |    3*   |     4    |
|    Closure by voting  |    4    |     5    |    5    |
| **Apps**                 |
|    Standard closure |    2    |     5    |    8    |
|    Anticipated closure |    3*   |     7    |
|    Closure by voting  |    7    |     8    |    9    |
| **Infra**                |
|    Standard closure |    2    |     3    |    4    |
|    Anticipated closure |    3*   |     3    |
|    Closure by voting  |    3    |     4    |    5    |
| **Communication -> Com** |
|    Standard closure |    2    |     2    |    3    |
|    Anticipated closure |    3*   |     3    |
|    Closure by voting  |    3    |     3    |    4    |
| **Communication -> Doc** |
|    Standard closure |    1    |     1    |    Council    |
|    Anticipated closure |    2*   |     2*   |
|    Closure by voting  |    Council    |     Council    |    Council    |
| **Distribution**         |
|    Standard closure |    1    |     Council    |    Council    |
|    Anticipated closure |    1    |     Council    |
|    Closure by voting  |    1    |     Council    |    Council    |

\* of which 1 view can be external to the group

For the translation group, the process needs to be adapted. 

For the documentation group, the number of views for an anticipated closure of a minor decision eat for the moment limited (there are only 2 people in the group). The other types of decision are taken by the Council.

For the distribution group, since there's only Heyyounow at the moment, the Council will have the task of making Standard and Major decisions.

## Administration group's rights
This part list administration rights for differents groups of YunoHost project:

(Warning, this is not decision rights here).

### Council
- No administration right. Authorizations are completed through the other groups membership,
- Forum: ["Conseil" group member](https://forum.yunohost.org/groups/Conseil).

### Core Dev
- GitHub: Devs team member inside YunoHost's organization (permission to push, merge…),
- Redmine: project member of [`YunoHost`](https://dev.yunohost.org/projects/yunohost) and [`Moulinette`](https://dev.yunohost.org/projects/moulinette),
- Continous integration: writting access to CI-Core,
- XMPP: ["dev"](xmpp:dev@conference.yunohost.org?join) channel moderator,
- Forum: ["Dev" group member](https://forum.yunohost.org/groups/Dev).

### Infra
- Servers: SSH access using SSH key on some (as needed) or every servers,
- GitHub: [Infra team member inside YunoHost's organization](https://github.com/orgs/YunoHost/teams/infra) (permission to push, merge…),
- Redmine: [Infra project member](https://dev.yunohost.org/projects/y-u-no-infra/),
- Forum, Weblate, Redmine, XMPP, CI: administrator,
- Forum: [Infra group member](https://forum.yunohost.org/groups/Infra).

### Apps
- GitHub: YunoHost-Apps [Owner](https://github.com/orgs/YunoHost-Apps/people?utf8=%E2%9C%93&query=%20role%3Aowner) (permission to push and merge on all repositories),
- Redmine: [Apps project member](https://dev.yunohost.org/projects/apps),
- GitHub: [Apps team member inside YunoHost's organization](https://github.com/orgs/YunoHost/teams/apps) (permission to push, merge…),
- Continous integration: access to [CI-Apps](https://ci-apps.yunohost.org),
- XMPP: [Apps channel moderator](https://im.yunohost.org/logs/apps),
- Forum: [Apps group member](https://forum.yunohost.org/groups/Apps).

### Communication
- Forum: [Com group member](https://forum.yunohost.org/groups/Communication).

#### Documentation
- GitHub: [Doc team member of YunoHost's organization](https://github.com/orgs/YunoHost/teams/doc).

#### Communication
- Diaspora*: [account access](https://framasphere.org/people/01868d20330c013459cf2a0000053625),
- Twitter: [account access](https://twitter.com/yunohost),
- Forum: [account access](https://forum.yunohost.org/users/yunohost/activity).

#### Translation
- Weblate: [translator tool admin](https://translate.yunohost.org/projects/yunohost/).

#### Mutual assistance (support)
- Forum: moderator status,
- XMPP: [`support` chanel moderator](xmpp:support@conference.yunohost.org?join).

### Distribution
- GitHub: [YunoHost's organisation `Distrib` team member](https://github.com/orgs/YunoHost/teams/distribution),
- Information: image distribution (ISO…) should be done in collaboration with `Infra` group (and `Doc`),
- Publication: SFTP access can be set up,
- Forum: [`Distribution` group team member](https://forum.yunohost.org/groups/Distribution).

## Pending decisions for the groups

### Council
- Should we elect Council members rather than co-opt them? There's a risk of it becoming a "political campaign"!
- Should special interest group membership be restricted to cooptation like for the Council?
- Proposal to change Council to Collegiate
- Migrate the project infrastructure server under YunoHost (with prepackaged apps like pad, dogs and mumble?)
- New system for documentation
- Improvement of documentation
- XMPP server migration
- Hosting of our Git forge
- Review the build system: stable <— testing <— branches
- Freeze nohost.me and abandoning services

### Core Dev Group
- How to manage pull requests?
   - Each ticket gives rise to a branch and a ticket; you make a pull/merge request, the community verifies that it works, a decision is taken to integrate. 

### Apps Group
- For community-based apps, issues are on GitHub as they should be, but discussions are on the forum

### Communication Group
- Bug report from the forum
- Cleanup of the forum to avoid noise
- Proposal to delete support chat
- How to make the forum a more active and central hub
- How to organise rights on the forum (if groups want to vote on the forum)

### Miscellaneous
- Request on the forum with notification to the Council members and to representatives of relevant special interest groups
- Vote over 2 weeks with a post on the forum
- Create 4 channels for Core Dev, Apps, Communication and Infrastructure
- A release should be validated by all 4 (or 5) interest groups
- Communication in French and English
- Directory or group contact for new people. Maybe just a directory to know who's who. https://yunohost.org/#/contribs to be completed. And to be highlighted.
- Proposal to leave YunoHost members auto-determine themselves -> How to manage access rights?

## Current means of communication

- Get-togethers at events
- Weekly Mumble meetings
- [Forum](https://forum.yunohost.org).
- Mailing lists: [contrib](https://list.yunohost.org/cgi-bin/mailman/listinfo/contrib) and [apps](https://list.yunohost.org/cgi-bin/mailman/listinfo/apps)
- [Bugtracker Redmine](https://dev.yunohost.org).
- Git Forge for code reviews: [YunoHost](https://github.com/YunoHost) [YunoHost-Apps](https://github.com/YunoHost-Apps).
- [XMPP chat rooms](https://yunohost.org/#/chat_rooms)
