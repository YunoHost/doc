---
title: Use Git to package apps
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_git'
---

Git... Our dear beloved Git, which can be described also as "Goddamn Idiotic Truckload of sh*t", according to Linus.  
Be sure if you don't know Git yet that you will soon agree with that description.

YunoHost and all our apps are on the Git forge GitHub. Which means that if you want to work on an app, sooner or later you're going to have to deal with Git.  
So let's see how to work with Git to be able to contribute in the context of YunoHost.

## Working with GitHub

Let's go first for the easy part, GitHub comes with an "easy" web interface to deal with.

*First things first, unfortunately there's no way around, you need an account on GitHub.*

#### Branches

Then, probably one of the most important thing, **do not work directly on the master branch**.  
Sorry, it has to be said !

Branches are, as GitHub explains, "*a parallel version of a repository. It is contained within the repository, but does not affect the other branches. Allowing you to work freely without disrupting the "live" version.*"

The master branch is the branch that contains the version of the app users will actually install and use.  
The usual thing to do is to work from the testing branch, and when everything is settled and tested, you can merge the testing branch in master, so users will enjoy the new release of your package.

To see and change the current branch, use this button:  
![](image://github_branch.png)

#### Edit a file

Now that you're on the right branch, let's see how to edit a file on GitHub.

You can edit any file by using the small pencil icon:  
![](image://github_edit.png)

If you don't have the permission to write on the repository, you will see (as on the picture) that you're going to create a fork (we'll see below what a fork is).  
If you have the permission to write, you will just edit the file, without forking.

#### Commit your changes

When you're done with your modification on the file, you can commit your changes.  
Behind that word, the idea is quite simple, you're just going to save your changes...  
![](image://github_commit.png)

The first field is the name of your commit, a very short sentence to explain why you did this modification.  
The second field is a large one for a more complete explanation, if you need it.

Finally, if you're editing a repository on which you have permission to write, you can either commit directly to the current branch or create a new branch.  
It's usually better to create a new branch, that way you keep your modifications on a *parallel* version of the repository. Your modifications will be discussed in a pull request (explained below) then finally merged into the original branch.

#### To fork or not to fork

A fork is a copy of a repository into your own account.  
We have seen before that if you don't have permission to write into a repository, editing a file will automatically create a fork.  
Because the fork is on your account, you always have the permission to write on it.  
But even if a fork is not the real repository, but just a copy, a fork is always linked to its parent. We'll see later that to create a fork is really useful when opening a pull request.

When you create a new package, it's common to use the [example app](https://github.com/YunoHost/example_ynh) as a base.  
But, because you don't want to keep that link to the example app, you should not fork the example app. You will rather clone the app.  
Unfortunately, to clone an app is a little bit trickier on GitHub. We will see later how to clone to a local repository instead.

We have seen how to edit a file, and how this could fork the app.  
But, when you want to edit multiple files, the GitHub interface isn't really the best way. In such situation, you would rather clone the repository and work on a local repository.  
You may still need to fork on your own account to be able to save your modifications if you don't have the permission on the distant repository.

#### Pull request

After you have committed your changes, whether on a branch or a fork, you want to propose your modifications to be integrated into the main repository, or the original branch.  
To do so, you're going to *create a pull request*. GitHub usually ask you directly if you want to do so.  
Otherwise, you'll find the button to create a pull request just here:  
![](image://github_pull_request.png)

When creating a pull request from a fork, to ease the work of the reviewers, **do never** uncheck the checkbox *Allow edits from maintainers*. That option simply allow the maintainers of the original repository to edit directly your work.

#### YunoHost-Apps organization

Following the [YEP 1.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines.md#yep-17), your app has to be into the YunoHost-Apps organization, but if you have never contributed to an app before or never had any app into this organization you may not have the permission.

First, you need the permission to write into the organization, to do so, ask to the Apps group on the Apps XMPP room.

To transfer your app to the YunoHost-Apps organization, go to your repository and to *Settings* tab.  
At the bottom of the page, you will find *Transfer ownership*.  
Into the field *New owner’s GitHub username or organization name*, type *YunoHost-Apps*.  
Your repo will be moved into the organization, you don't have to remove the original repository.


## Working with Git locally

As we have seen, you can do a lot of things directly on GitHub.  
But when you need to edit multiple files, or when you need to work on your code on your own, it's better to work directly on your computer.

Before going to the hellish part of Git, let's see 2 different ways to start working with Git.

#### First case: Creating a new package

You have shockingly discovered that the wonderful app you love to use everyday does not yet have its YunoHost package. And because you're nice, you decided to create yourself the package, so everyone will enjoy that app the way you do.  
What a good idea !

The best is to start from the [example app](https://github.com/YunoHost/example_ynh). But as we have explained before, you don't want to fork, because if you do so, you're going to keep that link to the example app and it's really annoying.  
So, you're going to do it differently. You're going to clone !

##### git clone

To clone, you're going to do:
```bash
git clone https://github.com/YunoHost/example_ynh
```
`git clone` will download a copy of the repository. You will have the complete repository, with its branches, commits, and everything (into that apparently little `.git` directory).

To git clone is usually the starting point of any local work with Git.

*A side note though, if you expect to send your modifications back to the distant repository on GitHub, be sure to have the permission to write on this repository. Otherwise, fork before and clone your fork, on which you do have the permission.*

##### My brand new package, continued

In the context of a new package, you will also need to create a repository on GitHub to nest your package.
Which is as simple as a big green *New* button.  
Don't bother with README, .gitignore or license. Just create the repository itself.  
you can now git clone that new repository.  
![](image://github_create_new_repo.png)

You now have 2 repositories cloned on your computer.  
Copy all the files from the example_ynh app, **except the .git directory** (You just want the files themselves) to your new package.  

*If you want, you can remove the example_ynh app. We don't need it anymore.*

You're ready to work on your new package !

#### Second case: Working locally on a repository

You already have a repository, but what you want is just to work locally, so you can modify multiple files.  
Simply clone the repository, the .git directory is the link to the distant repository. Nothing else to do than a `git clone`.

#### Branches

You do have your local copy of the repository, but because you have read carefully this documentation until then, you know that you should be sure to be on the testing branch before starting to work.

To see the branches, and to know on which you actually are, while into the directory of your repository, type `git branch`.  
The current branch is highlighted and preceded by a `*`.

#### git checkout

If it appears that you're not on the branch you wanted to be, or you're actually on master (which is bad !), you can move to another branch with `git checkout`
```bash
git checkout testing
```
*Read carefully what Git says when you validate a command, do never forget that Git is sneaky...*

#### Git pull before anything else

You're finally on the right branch, and ready to work.  
**Wait ! A nasty trap is waiting for you...**  
Before ending up in an inextricable situation. Start with a `git pull` to update your branch to the latest change from the distant repository.

*Sometimes, you will encounter an impossible situation where Git is saying that you can't pull because you have local changes. But you don't care of those local modifications, you just want to get the last version of the distant branch. But Git don't care about what YOU want...*  
*I have to admit that my only solution is as highly efficient as dirty... A good old `rm -r` of the repository and a `git clone`*

#### Let's work

Eventually, you can work on your code.  
When you are finally ok with what you have done, it's time to validate your work.

The first step is to inform Git about which file(s) to validate. To do so, we'll use `git add`
```bash
git add my_file
git add my_other_file and_also_this_one
```
If you want to validate all your work, you can also simply do
```bash
git add --all
```

To check the current status of your validation, you can use `git status`. It will show you which files will be included into your commit, and which files are modified, but not yet included.  
`git status -v` will show also which part of the files are modified. A good way to be sure that you didn't make a mistake before committing.

#### git checkout -b

Before committing, or after, or before starting to work. Whenever you feel like it !  
You should consider adding your work to a separate branch, that way, it will be easy to create a pull request to merge into the testing branch and discuss with the other packagers what you suggest to change.

To create a new branch and move to this branch, you can use `git checkout -b my_new_branch`.

#### Commit

To commit is simply to validate your work in Git. As you can do in GitHub.  
To have the same fields that you had on GitHub, with the name of the commit, and a longer explanation. You can simply use `git commit`.  
The first line, before the comments, is for the name of the commit.  
After all the comments, you can add an explanation if you want to.

If you want to commit with only a name for your commit, you can use a simple command:
```bash
git commit -m "My commit name"
```

#### Push to the distant repository

Your changes are validated, but only on your local clone of the repository. Now, you have to send those modifications back to the distant repository on GitHub.  
In order to do that, you need to know what is your current branch. (If you don't know, `git branch` will give you that info).  
Then you can git push
```bash
git push -u origin BRANCH_NAME
```
