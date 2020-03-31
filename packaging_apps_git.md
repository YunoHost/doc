# How to use git to package apps

Git... Our dear beloved Git, which can be described also as "Goddamn Idiotic Truckload of sh*t", according to Linus.  
Be sure if you don't know git yet that you will soon agree with that description.

YunoHost and all our apps are on the git forge GitHub. Which means that if you want to work on an app, sooner or later you're going to have to deal with git.  
So let's see how to work with git to be able to contribute in the context of YunoHost.

### Working with GitHub

Let's go first for the easy part, GitHub comes with an "easy" web interface to deal with.

*First things first, unfortunately there's no way around, you need an account on GitHub.*

#### Branches

Then, probably one of the most important thing, **do not work directly on the master branch**.
Sorry, it has to be said !

Branches are, as GitHub explains, *"a parallel version of a repository. It is contained within the repository, but does not affect the other branches. Allowing you to work freely without disrupting the "live" version."*

The master branch is the branch that contains the version of the app users will actually install and use.  
The usual thing to do is to work from the testing branch, and when everything is settled and tested, you can merge the testing branch in master, so users will enjoy the new release of your package.

To see and change the current branch, use this button:
<img src="/images/github_branch.png" width=100%>

#### Edit a file

Now that you're on the right branch, let's see how to edit a file on GitHub.

You can edit any file by using the small pencil icon:
<img src="/images/github_edit.png" width=100%>

If you don't have the permission to write on the repository, you will see (as on the picture) that you're going to create a fork (we'll see below what a fork is).  
If you have the permission to write, you will just edit the file, without forking.

#### Commit your changes

When you're done with your modification on the file, you can commit your changes.  
Behind that word, the idea is quite simple, you're just going to save your changes...

<img src="/images/github_commit.png" width=100%>

The first field is the name of your commit, a very short sentence to explain why you did this modification.  
The second field is a large one for a more complete explanation, if you need it.

Finally, if you're editing a repository on which you have permission to write, you can either commit directly to the current branch or create a new branch.  
It's usually better to create a new branch, that way you keep your modification on a *parallel* version of the repository. Your modifications will be discussed in a pull request (explained below) then finally merged into the original branch.

#### To fork or not to fork

A fork is a copy of a repository into your own account.  
We've seen before that if you don't have permission to write into a repository, editing a file will automatically create a fork.  
Because the fork is on your account, you always have the permission to write on it.  
But even if a fork is not the real repository, but just a copy, a fork is always link to its parent. We'll see later that to create a fork is really useful when opening a pull request.

When you create a new package, it's common to use the [example app](https://github.com/YunoHost/example_ynh) as a base.  
But, because you don't want to keep that link to the example app, you should not fork the example app. You will rather clone the app.  
Unfortunately, to clone an app is a little bit trickier on GitHub. We will see later how to clone from a local repository instead.

We've seen how to edit a file, and how this could fork the app.  
But, when you want to edit multiple files, the GitHub interface isn't really the best way. In such situation, you would rather clone the repository and work on a local repository.  
You may still need to fork on your own account to be able to save your modifications if you don't have the permission on the distant repository.

#### Pull request

After you have committed your changes, whether on a branch or a fork, you want to propose your modifications to be integrated into the main repository, or the original branch.  
To do so, you're going to *create a pull request*. GitHub usually ask you directly if you want to do so.  
Otherwise, you'll find the button to open a pull request just here:
<img src="/images/github_pull_request.png" width=100%>

When creating a pull request from a fork, to ease the work of the reviewers, **do never** uncheck the checkbox *Allow edits from maintainers*. That option simply allow the maintainers of the original repository to edit directly your work.

#### YunoHost-Apps organization

Following the [YEP 1.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines.md#yep-17), your app has to be into the YunoHost-Apps organization, but if you never contribute to an app before or never had any app into this organization you may not have the permission.  

First, you need the permission to write into the organization, to do so, ask to the Apps group on the Apps xmpp room.

To transfer your app to the YunoHost-Apps organization, go to your repository and to *Settings* tab.  
At the bottom of the page, you will find *Transfer ownership*.  
Into the field *New owner’s GitHub username or organization name*, type *YunoHost-Apps*.  
Your repo will be moved to the organization, you don't have to remove the original repository.

