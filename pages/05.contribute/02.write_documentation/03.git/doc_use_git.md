---
title: Propel a contribution with GitHub
template: docs
taxonomy:
    category: docs
routes:
  default: '/doc_use_git'
---

It is of course possible to contribute directly to the YunoHost documentation, but this is not the most convenient way to do so for both the contributor and the person who will inject your contribution into the documentation. Here is a tutorial to understand and create a contribution to the YunoHost documentation using [Git](https://git-scm.com/) and [github.com](http://github.com/) which is the Git forge service that hosts and stores the YunoHost source code and documentation.

## Create an account on github.com
To be able to send your contributions via GitHub, you need to have an account on GitHub, to create the account you will need a valid email address that you have access to. GitHub is a powerful tool with many features, the interface can be a little scary at first.
You don't have to give your first and last names, you can use a nickname (when you register `Username`).

## Fork the YunoHost documentation in your personal repository
To fork the source code allows you to create a new branch of development of a software source code or in this case the source code of the documentation. By creating a new branch, this allows you to modify the code and add your contributions without altering the code of the `master` branch, which is the public release of the documentation. This allows you not to have to write down everything at once, but to do it in several steps. (Especially for contributions that require more time).

Forking a project on GitHub is extremely simple, just click on the Fork button, this will create a new repository on your GitHub account.
![Screenshot GitHub fork button screenshot](image://github_fork_button.png)
In the title of the new repository, you will see where the repository comes from, in this case `YunoHost/doc`.
![Screenshots title and subtitle of the repository](image://github_fork_title.png)

> **Point of vigilance !**
> If you forge the repository of another contributor than yunohost, you'll get the same files. Except that when you send your changes, they will be sent to the contributor and not to the yunohost repository. The advantage is that it allows you to develop another branch created by the contributor and work with another person on an improvement before submitting it to the main repository.
> It is not possible to have a fork from a contributor's repository and the original repository fork at the same time in your own account.

## Modify and add your contribution
Once the repository is forked (copied), you will need to create a new development branch within your repository. It is through this branch that you will modify the files and thus propose improvements to the documentation. The fact that it is a new branch will allow you to make a Pull Request, i.e. a request to add your contributions to the `master` branch, which is the main documentation branch. The development rules on GitHub change depending on the developers of each repository, some have a testing branch in which to offer contributions.
More information on what a branch on git-scm.com is: [Branching with Git - What a branch is](https://git-scm.com/book/fr/v1/Les-branches-avec-Git-Ce-qu-est-une-branche).

## Send your contribution by a Pull Request
Create a Pull Request when you want to share your work with the other contributors and integrate it into the master repository (YunoHost's main repository). When publishing a Pull Request, commonly called PR, contributors will be able to amend, comment, add, correct your contribution before it is fully integrated into the repository.

## Track your contribution and take into account feedback from contributors
When you've already create a Pull Request (PR), changes to your development branch in the Git repository will automatically be added to the PR. This doesn't require any additional action. You can also include proposed changes from contributors, who, when they audit the code, may find errors or new, better wording.

## Bringing up mistakes and wishes through issues
YunoHost has a specific Git repository to collect issues: [github.com/YunoHost/issues](https://github.com/YunoHost/issues)
An issue, also called a ticket, is an identified problem or a development wish; in this case for documentation, but it is valid for any software repository. Within the framework of the YunoHost documentation it will be mainly proposed issues for the development of the documentation, the identified problems being easily correctable.

## Going further with Git and working on his workstation
Using the power of Git to work on your personal computer means you don't have to create a `commit` each time you save modified documentation pages. It also allows you to use tools and software that make it easier to distinguish between tags used in a documentation page.

- Online resource: [docs.microsoft.com - Setting up a Git repository locally for documentation](https://docs.microsoft.com/fr-fr/contribute/get-started-setup-local)

## Some resources elsewhere on the net to go further
 - [Managing your code with Git and GitHub - openclassrooms.com](https://openclassrooms.com/fr/courses/2342361-gerez-votre-code-avec-git-et-github)
 - [Git User Interface - git-scm.com](https://git-scm.com/download/gui/linux)
