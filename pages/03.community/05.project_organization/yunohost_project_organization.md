---
title: Project organisation
template: docs
taxonomy:
    category: docs
routes:
  default: '/yunohost_project_organization'
  aliases:
    - '/project_organization'
---

! This page is outdated and should be reworked

# Goal of this document

This document aims at describing the structure and the way the collective works to make development and maintenance of YunoHost possible.
More specifically, in line with the values of the project, it is important to:

- maintain transparency on the functioning of the collective and the values of the project
- explain the open nature of the project, so that outsiders feel entitled to contribute to the project, by joining or not joining the collective
- enable the members of the collective to feel legitimate to discuss, contribute and act on decisions
- make the project sustainable, by sharing knowledge and responsibilities, by limiting the “bus factor”
- limit power asymmetries
- have a formal decision-making mechanism, e.g. to resolve a conflict, or to develop the collective or the project

# Goal of the YunoHost project

In a context where the evolution of technological tools lead to major societal challenges, YunoHost advocates an Internet that is decentralised and that allows people to remain in control of their data and their digital tools. One of the tenets of such an Internet is to drastically simplify, make accessible and to democratise server administration, when this is traditionnaly reserved to a technical elite.

As such, the goal of the YunoHost project is to build an operating system and all the necessary tools to install and administer, autonomously and without too many technical skills, a server and digital services in a private context (family, group of friends…) or collective (non profit, company, school…).

The YunoHost collective is close to other like-minded collectives, such as FFDN, Framasoft, CHATONS, or La Quadrature du Net. The collective is also sensitive to ecological issues and inclusivity.

## Spirit and values of the project

0. 1. **Digital commons**: all software produced by the YunoHost project is published as Free Software and will remain Free. YunoHost is developed and maintained mostly by volunteers in an open, horizontal community, that does their best with the time, means and energy they have.

1. 2. **Accessibility**: the design of YunoHost is centered on people with little technical knowledge. Its processes, interfaces and documentation should be simple and educational.

2. 3. **Security**: YunoHost must provide a fairly up to date system, with reasonable security by default, and guide the users on ways to harden their system.

3. 4. **Hackability**: YunoHost must allow its users to take ownership of and modify their installation, to adjust it to their needs, or specific use cases, or uses that are not yet covered, or to tweak the look and feel.

# Yunohost organization's
Yunohost is developed and maintained by community of volunteers. The community has an open and horizontal structure.

Members of Yunohost are part of :
- regular users
- occasional contributors
- regular contributors

The community organizes regulary meetings who are open to everyone. You can find the date on the forum of project. <small>(Actually these meetings are planned the 1st and 3rd tuesday every month on Mumble.)</small> The notes of these meetings are public as well.

## Users

This refers to the people who use YunoHost in their daily life, who ask for help, speak about bugs and make contributions.

The community is aware about the importance to listen to users and take advice about their contributions for the future of the project.

## Occasional contributors

These are the people who contribute to the project on an ad hoc basis. Any person wishing to do so is, without prior agreement, welcome and entitled to contribute to the project (provided that they do not go against the values of the project).

The community provides as much documentation and tools as possible to guide new contributors in their first contributions in a spirit of caring.

Contributions often take the form of *Pull Request* (PR) (for example, on the *core*, on the apps, on the doc, ...) but can also be translations, graphic elements, security audits, etc...

With some exceptions, occasional contributors can help with reviews, but they do not act to integrate their work into the project. They also do not have a vote in formal decision-making. They are, however, welcome to express their opinions if they wish.

## Regular contributors (RC)

These are the people who regularly contribute to the project in the form of work, ensure the review and integration of the work of other contributors, as well as the short and long term maintenance of the project as a whole.

Regular contributors are organised into working groups:

- **Core Group**: work on the central system part of the project (mainly YunoHost, YunoHost-Admin, Moulinette, SSOwat repositories) and on the distribution tools (.deb packages, preinstall images) and development (ynh-dev)
- **Apps Group**: focus on new applications packaging and collectively maintain current apps, work also on catalog index, define good packaging practices and metrics tools for quality control.
- **Infra Group**: deploys, administers, maintains and saves the various services needed by the project (documentation, forum, chatrooms, demo, paste, stack mail, CI, diagnostic, dynette, dashboard, …)
- **Support / doc / comm group**: animates the mutual aid on the forum and the support rooms, ensures the maintenance and update of the doc, communicates on the evolutions of the project on the forum, the social networks, or in conference.

Since there are multiple connections between these different themes, it is not uncommon for a person to be a member of several of these groups.  Nevertheless it is necessary and sufficient to be a member of one of these groups to obtain the status of regular contributor.

Anyone who has already contributed at least once to the project can apply for regular contributor status.  This request is then subject to a vote of acceptance by all the other regular contributors.

Being a member of a group entitles you to certain administrative rights detailed in appendix A, typically the right to validate and integrate your own work or the work of other contributors.  Good use should be made of these rights as described in the next section.  Being regular contributors also makes it possible to propose a vote when it is necessary to formally record a decision for the project.> []

Regular contributors are expected to coordinate regularly with the rest of the team, for example by participating in meetings or via chat and forum.

The loss of membership of a group takes place by voluntary departure of the person, or following a vote of radiation for inactivity, non-respect of the charters or the values of the project, or abuse of the rights of administration.


# Validation and integration of PR

Due to the nature of the project, contributions are mainly made in the form of "pull requests" (PR) or "merge requests" (MR). The realization, the review, and the collective validation of PRs are important issues, since they are precisely what makes the project alive from a purely technical point of view.

Behind each integration request can be hidden various human and technical issues among which stability (not breaking everything because of an unforeseen branching), security (not introducing flaws or malicious code), durability (limiting the *bus factor* and the technical debt), pragmatism ("good enough"), agreement with the spirit of the project (UX, ..), evolution on the short and long term. The review and validation process of a PR is also a complicated exercise insofar as it is time consuming, and can be a source of tension or frustration. One of the obstacles to the validation of a PR is also often linked to a feeling of lack of legitimacy in accepting the integration of a PR, or to the psychological impact of being the person who has accepted the integration of a PR.

A crucial issue in the organization of the project is therefore to find a set of rules and good practices that allow for a fluid, balanced operation, with validation as much as possible by consensus, and that distributes the responsibility to the collective rather than to individuals.

## Best practices and recommendations

- When a job has significant implications (or, for occasional contributors), it is strongly encouraged to discuss it in advance with the rest of the team to ensure that the imagined implementation fits with the spirit of the project and with the other work of the team.
- Correctly describe its RP and the problem it addresses (and if applicable, the technical details needed to test)
- Ensure the correction of problems reported by the automatic testing tools (CI)

## Validation process

This section details the process of validating the RPs in the different repositories of the project. The objective of this process is to achieve a "soft consensus".

Contributors are individually and collectively responsible for gauging the importance of an RP to define the extent to which it should be lightly or thoroughly validated by other group members.

- The "micro" PR: it is a typographical correction, a correction for an obvious bug... These PR can be integrated by its author without explicit validation by another member of the group.
- Medium" PRs: these are maintenance operations (e.g. updating an application, minor cleaning/refactoring, adding a small feature, ...). It is usually better to get a validation from another member of the group.
- The "big project" PRs: these are new features or important refactorings, with major consequences for the future of the project or the app. It is then strongly advised to obtain a thorough validation by at least one other member of the group, and an agreement in principle from the other members.

Other contributors may freely take part in the review of an RP. The author of an RP may also request or remind other contributors that their RP is awaiting review. After a certain period of time, if it appears that no contributor has time or energy available to participate in the review of an RP, then it can still be merged by its author.

If a disagreement emerges during or after the validation of a PR, a cordial discussion should be held with the rest of the team in order to reach a consensus on the way forward. If no consensus is reached, a vote is held to make a decision, in which all regular contributors to the project can participate.

# Collective decision making

When Regular Contributors need to make a formal decision about the project ("resolution"), or to resolve a conflict after a consensus search has failed, any Regular Contributor can initiate a formal voting process. All regular contributors can take part in this vote.

# Appendix A. Group Administration Fees

This part lists the administration rights for the different groups of the YunoHost project.

N.B. these are not decision making rights, but access and modification rights on the different platforms used by the project.

Members of these groups agree to abide by [the project's system administration policy](adminsyscharter.md).


### Core
- GitHub: member of the [Devs team of the YunoHost organization](https://github.com/orgs/YunoHost/teams/devs) 
    - permission to create branches, merge PRs (respecting the rules stated above)
- Continuous integration: access rights to Gitlab to interact with the CI core?
- Forum: member of the [Dev group.](https://forum.yunohost.org/groups/Dev)
-Chatrooms: admin on the Dev chatroom


### Apps
- GitHub: (Owner) [of the YunoHost-Apps organization](https://github.com/orgs/YunoHost-Apps/people?utf8=%E2%9C%93&query=%20role%3Aowner)
    - permission to create branches and merge PRs on all app repositories (respecting the rules stated above)
- Github: member of the [`Apps` team of the `YunoHost` organization](https://github.com/orgs/YunoHost/teams/apps)
    - permission to create branches and merge PR on the catalog repository (apps), exampleynh, packagelinter, packagecheck, ... (respecting the rules stated above)
- Forum: Member of [`Apps` group](https://forum.yunohost.org/groups/Apps).
- Chatrooms: admin on the Apps chatroom

### Infra
- Servers: SSH access by key on some (as needed) or on all servers,
- GitHub: member of the [`Infra` team of the `YunoHost` organization](https://github.com/orgs/YunoHost/teams/infra),
- Forum, Weblate, XMPP, CI: administrator,
- Forum: member of the [`Infra` group](https://forum.yunohost.org/groups/Infra).
- Chatrooms: admin on the Dev and Infra chatroom

### Support, Doc, Communication, Translation
- GitHub: member of the [`Doc` team of the `YunoHost` organization](https://github.com/orgs/YunoHost/teams/doc).
    - permission to create branches and merge PRs on the "doc" repository (respecting the rules stated above)
- Forum: moderator status, member of the [`Support & Doc` group](https://forum.yunohost.org/groups/SupportDoc), possibility to have the group badge visible next to the avatar.
- Diaspora*: access to the account [YunoHost](https://framasphere.org/people/01868d20330c013459cf2a0000053625),
- Twitter: access to the [YunoHost](https://twitter.com/yunohost) account,
- Weblate: administrator on the [translation tool](https://translate.yunohost.org/projects/yunohost/).
- Chatrooms: admin on the Doc chatroom


# Appendix B. Composition of the different groups 154

Last updated on 2022-03-15

- **Core** : Aleks, Bram, Kayou, ljf, Tagadda, axolotle, tituspijean
- **Apps** : Ericg, Josue, Kayou, tituspijean, yalh76, frju365, Tagadda
- **Infra** : Aleks, Bram, Kayou, ljf, yalh76, tituspijean
- **Support/doc/comm/trad/bureaucracy** : Aleks, Ericg, ljf, tituspijean, Tagadda, JimboJoe, wbk

# Appendix C. Resolutions

- On the fact that the commercial sale of services related to YunoHost, such as distribution, support, or outsourcing, is allowed.
- On good app packaging practices, in particular to respect the common practice defined in exampleynh rather than factoring
- Meeting dates
- On the criteria for integrating apps into the catalog
