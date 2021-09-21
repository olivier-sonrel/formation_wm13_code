## Getting Started

This file tells you how to set up your Vagrant virtual machine with VirtualBox.

First, you have to install requirement :

#### Requirements (Windows/Linux/MacOs):

These requirements are for Windows/Linux/MacOs  

> On windows, install all with administration right !!

  1. [Windows/Linux/MacOs] Download and Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) !! Please use Version 5.2 !!  
        A tutorial for windows (if necessary):  
        - https://websiteforstudents.com/installing-virtualbox-windows-10/  
         !! It's not necessary to install the VirtualBox extension pack. !!
  2. [Windows/Linux/MacOs] Download and Install [Vagrant](https://www.vagrantup.com/downloads.html)  
  4. [Windows/Linux/MacOs] Install [Git](https://git-scm.com/downloads)
        A tutorial for windows (if necessary):  
        - https://www.grafikart.fr/tutoriels/install-git-windows-582  
        - Format video de grafikart: [video](https://www.youtube.com/watch?v=G0UV0jKgV4Y)
  
#### Clone Project and Vagrant-Ansible Project From Gitlab/Github/...
1. Create the Architecture  

First, create a folder for "global project". Like `../Cagibig`  
The directory will contain all projects (and the infra part, like this VM).  
So this folder is our working dev directory.  

Inside this folder we need to have others folders (project folder from git, VM folder with ansible,...):
- The VM with vagrant (on vagrant folder)
- The projects website like `cagibig-mut`

So, the structure need to be (depending the poject, you work on) :
```
Global Project (Cagibig)
├── vagrant
└── cagibig-mut
```
(So may be, you need to create these folders)

2. Clone project

Repository on gitlab for [Cagibig](https://gitlab.com/cagibig):  
You need to clone each repository on the good folder (if you have already create them):  
With SSH:  
`── vagrant` -> git@gitlab.com:cagibig/infra/vagrant.git  
`── cagibig-mut` -> git@gitlab.com:cagibig/projects/cagibig-mut.git  

Or with HTTPS:  
`── vagrant` -> https://gitlab.com/cagibig/infra/vagrant.git  
`── cagibig-mut` -> https://gitlab.com/cagibig/projects/cagibig-mut.git  

- How to do the git clone:
    - If you have already create projects (or/and VM) folders on `Global Project folder (Cagibig)` to clone you project the command will be, for example:
    ```shell
      ## Go inside you project folder
      cd my/path/to/my/project/folder/of/Cagibig/projectName/
      ## And clone you project from git
      git clone git@gitlab.com:cagibig/projects/cagibig-mut.git .
    ``` 
    > On this command `git clone "MygitUrl" .` the most important is `.` This is to say: "I want to put the project on the current folder" 

    - If the project folder is **not** already create projects (or/and VM) on `Global Project folder (Cagibig)`  
    ```shell
      ## Go inside the Global Project folder (Cagibig)
      cd my/path/to/my/project/folder/of/Cagibig/
      ## And clone you project from git
      git clone git@gitlab.com:cagibig/projects/cagibig-mut.git
    ``` 
    > On this command `git clone "MygitUrl"` This is to say: "Let Git create the project folder". Git will create the folder with the same name of the project
    
### Initialize Vagrant VM
###### On the vagrant project

2. Open a `shell prompt` (`Terminal` app on a Mac or `cmd` on Windows)  
 And cd into the folder `vagrant` who containing the Vagrantfile from the `vagrant` project  
 Like : `cd my/path/to/my/project/folder/of/Cagibig/vagrant/` 

3. Add the `vagrant-vbguest` plugin, with the following command:  
    ```shell
    ## Go inside the vagrant Project folder
    vagrant plugin install vagrant-vbguest
    ```
3. [Windows Only] Add the `Vagrant-WinNFSd` plugin, with the following command:  
    ```shell
    ## Go inside the vagrant Project folder
    vagrant plugin install vagrant-winnfsd
    ```
4. Run the following command to install the necessary for Vagrant VM:   
    ```shell
    ## Go inside the vagrant Project folder
    vagrant up
    ```  
Vagrant will create a new VM, install the base box, and configure it.  

###### Error Time
5. On error, please try to make a research about the error
6. Open a ticket on the [Trello](https://trello.com) or contact me @yvalentin on [Chat - Cagibig](https://cagibig.slack.com/)
7. You can rerun the provision script for the vm with:
```shell
  ## Go inside the vagrant Project folder
  cd my/path/to/my/project/folder/of/Cagibig/vagrant
  ## Rerun provision
  vagrant provision
``` 

### Setting up your hosts file
  
You need to modify your host machine's hosts file, depending your project:
- Mac/Linux: `/etc/hosts`;  
- Windows: `%systemroot%\system32\drivers\etc\hosts`), adding the line below:  

```
# For Annuaires Project
192.168.34.63 mutualisation.cagibig.dev
```

### Database
You can use database from Jetbrain IDE

#### Database Access

| name | login | password | comment |
| ---- | ----- | -------- | ------- |
| cagibig_mut  | cagibig_mut   | cagibig_mut123   | Access Cagibig Mut database |

### Update the vagrant box
#### Downloading the latest version
From the vagrant project folder, you an run the following command to update the box:
```shell
## Go inside the vagrant Project folder
cd my/path/to/my/project/folder/of/Cagibig/vagrant
## Update the box
vagrant box update
```

#### Updating your box Machine  
Note that after you had downloaded the latest version of Homestead, 
it doesn't automatically updates the virtual machine you are currently using. 
You have to destroy the currently running VM and re-provision it:

> **WARNING: all the databases and data inside your box machine will 
> all will be gone, so make sure to export it before proceeding!**

```shell
## Go inside the vagrant Project folder
cd my/path/to/my/project/folder/of/Cagibig/vagrant
## destroy the box
vagrant destroy
```
To rebuild your machine, you can issue vagrant up.
```shell script
## Go inside the vagrant Project folder
cd my/path/to/my/project/folder/of/Cagibig/vagrant
## rebuild the box
vagrant up
```

#### Purging old versions
You might want to delete the older base boxes as it may fill your disk space.
To do so:

- Get the list of box
```shell script
vagrant box list
```

- You can check if the box you are using is outdated with :
```shell script
vagrant box outdated
```
This can check if the box in your current Vagrant environment is outdated as well as any other box installed on the system.

```shell
## Go inside the vagrant Project folder
cd my/path/to/my/project/folder/of/Cagibig/vagrant
## purge old version of the box
vagrant box remove cagibig/ubuntu  --box-version=0.4.0
```

And that's it, you are done!

### Some tips   
- Go on the VM with SSH
    - Use your IDE  
    Like [PhpStorm: Use ssh for vagrant](https://www.jetbrains.com/help/phpstorm/using-the-advanced-vagrant-features-in-product.html#ssh-terminal)
    - Use a terminal on vagrant folder
    ```shell
      ## Go inside the vagrant-ansible from Ansible Project folder
      cd my/path/to/my/project/folder/of/Cagibig/vagrant
      ## Rerun provision
      vagrant ssh
    ``` 
- Use the following command to go to project base path on the VM  
    ```shell
    cd /var/www/html/annuaires
    ```

### End
Just go on (depending project needed) : 
- Cagibig Mut
    - https://mutualisation.cagibig.local

----
Created in 2020 by ©[Yohann Valentin](https://yohannvalentin.com) ;-)