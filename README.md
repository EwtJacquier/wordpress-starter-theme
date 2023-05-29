# Wordpress Starter Theme #

This theme is based on Automattic's Underscores theme, recommended by the company in Wordpress projects, being VIP or not.

## 1. Dependencies

* WAMP (Apache, PHP and MySQL) or Similar
* Git with Git Bash
* Composer
* PHP Code Sniffer
* Node with Windows Build Tools
* wordpress

## 2. Installation of Dependencies

### 2.1. WAMP

WAMP contains Apache, PHP and MySQL, essential to run any PHP project, especially Wordpress.

If you already have PHP, MySQL and Apache / Nginx configured in your environment, it will not be necessary to proceed with this installation.

I recommend WAMP because it has support for multiple versions of PHP, which is very useful for those who work with different projects with different versions of PHP for each one.

WAMP's weak point is that HTTPS configuration within Apache must be done manually and this ends up being a little annoying.

I recommend installing WAMP directly from their website:

https://www.wampserver.com/en/

### 2.2. GIT with GIT Bash

Git Bash is extremely useful for simulating linux commands and managing repository gitflow. Some prefer visual editors, but I strongly recommend using Git Bash.

When installing Git Bash I recommend setting the text editor to Nano over Vim, but this is preferred. The program gives both options and I prefer nano for editing files when needed. It is common to use this functionality in Merge processes.

I recommend installing Git directly from their website:

https://git-scm.com/downloads

### 2.3. composer

Composer is essential in PHP project development.

It is needed to install the code validator in PHP.

It is also possible to import a vast library of third-party code to aid in the development of your project.

I recommend installing Composer directly from their website:

https://getcomposer.org/download/

### 2.4. PHP Code Sniffer

PHPCS is a PHP code validation tool that needs Composer to be installed.

I strongly recommend using it in all PHP projects, as it helps with code security and the prevention of bad programming practices.

To install it, open the windows command prompt as an administrator and type the following command.

    composer global require squizlabs/php_codesniffer wp-coding-standards/wpcs phpcompatibility/phpcompatibility-wp wptrt/wpthemereview

The command will install 4 dependencies:

* PHP Code Sniffer
* WP Coding Standards
* PHP Compatibility WP
* WP Theme Review

For PHPCS to work properly, you need to set the code review pattern you prefer.

In this case, let's configure the code pattern recommended by Wordpress VIP, which is universally suitable for all PHP projects.

While still at the prompt, type the following command:

    phpcs --config-set default_standard WordPressVIPMinum

With that, we configure our PHPCS to use the code review standard called WordPressVIPMinum.

Using PHPCS is described in step 6 of this tutorial.

### 2.5. Node with Windows Build Tools

The node will be needed to compile and use some dependencies of this default theme.

I recommend downloading Node directly from their website:

https://nodejs.org/en/download

When installing, you will need to open the windows command prompt as an administrator and run the following command:

    npm install --global windows-build-tools

The above command will install tools to aid in installing and compiling Node dependencies on Windows.

Among these tools is Python.

## 3. Creating the initial project

As a requirement of this step, we need to have an empty repository created in github for the project.

With the repository URL in hand, we will have something similar to this:

    https://github.com/<your_username>/<project_name>.git

With windows explorer open, navigate to the Apache public folder on your WAMP:

    c:/wamp64/www/

Now, let's make a archive with a linux shell script and put it inside the folder mentioned above. The file should be named as "create_project.sh", and will have this lines of commands:

	# Recupera Variáveis
	echo "Github Project Name"
	read PROJETO
	echo "Github Username"
	read USUARIO
	# Create the project folder
	mkdir "$PROJETO"
	cd "$PROJETO"
	# Downloads the latest Wordpress
	curl https://br.wordpress.org/latest-pt_BR.tar.gz -o wordpress.tar.gz
	tar -zxvf wordpress.tar.gz
	mv wordpress/* .
	rmdir wordpress
	rm wordpress.tar.gz
	# Update the project with the pipeline repository 
	git clone https://github.com/"$USUARIO"/gitflow-pipeline.git
	rm -rf gitflow-pipeline/.git
	mv gitflow-pipeline/* .
	mv gitflow-pipeline/.gitignore .
	mv gitflow-pipeline/.git-ftp-ignore .
	rm -rf gitflow-pipeline
	# Create the Wordpress Theme Folder
	cd wp-content/themes
	mkdir "$PROJETO"
	cd "$PROJETO"
	# Update the project with the current start theme
	git clone https://github.com/"$USUARIO"/wordpress-starter-theme.git .
	rm -rf .git
	# Updates the NPM dependencies 
	npm install
	# Upload the project to the repository
	cd ./../../../
	git init
	git remote add origin https://github.com/"$USUARIO"/"$PROJETO".git 
	git add .
	git commit -am "Initializing project"
	git push origin master
	# Creates a develop branch for the project
	git checkout -b develop
	git push origin develop

This file will be in charge of creating a 100% up-to-date project within mustache standards.

For more information on the file's contents, see the video in the trainings folder.

Now, open git bash via the right-click menu.

    Right Click > More Options > Git Bash Here

With bash open, run the following command:

    bash create_project.sh

This file will be in charge of:

* Create an empty project with updated Wordpress
* Update the project with default theme
* Update the project with the default pipeline
* Upload the project to the repository with the develop and master branches created

After running bash, if there are no errors, the project has been created successfully.

From there, it will be necessary to create a database in your MySQL that will be requested when creating wordpress.

## 4. Creating the Project's Virtual Environment with Apache

Based on WAMP, we have the c:/wamp64/www/ folder, which is the root folder of your localhost.

Now, we have to identify the project folder created in the previous step:

    c:/wamp64/www/projectname

WAMP should automatically load your project in the browser when you enter the URL:

    http://localhost/projectname

Regardless of whether this URL works, we have to create a virtual host for each project.

This is to reduce redirection errors and extra settings in .htaccess files, which might end up in the production environment (if any process fails).

If a .htaccess file with subfolders arrives in a production environment, the site may crash or experience redirection errors.

So the goal is to make our project work on a local URL similar to this one:

    http://projectname.local/

That said, with WAMP running on windows, let's click on the WAMP icon in the taskbar and go to:

    Apache > Your VirtualHosts > VirtualHost Management

This will open a screen in our browser, with the management of virtualhosts.

Now we just need to fill in the name of the virtual host like "nameofproject.local" and put the path of the project folder, which is usually in:

    c:/wamp64/www/projectname

With these two fields configured, just click on the "Start the creation of the VirtualHost" button

After creation, we still need to tinker with our Windows hosts file, so that the URL is recognized by any browser.

Next, let's edit the hosts file inside the folder:

    c:/windows/system32/drivers/etc/

The file can be edited with a standard text editor if you like.

With the file open, just add the following line:

    127.0.0.1 projectname.location

This will make the URL recognized by browsers.

Lastly, let's click on the WAMP icon on the taskbar and restart WAMP.

    Restart All Services

The project can now be accessed via the URL

    https://projectname.local/

## 5. Validating Codes with PHPCS

At first, the code validator should only be used within the project's theme folder.

This happens because we shouldn't change any code outside the project's theme folder, that is, we don't touch the wordpress core or third-party plugins.

The only exception is the plugin being made by Mustache, then PHPCS must be run inside the plugin folder.

Inside the theme folder, you need to open the git bash / prompt and type the command:

    phpcs -a .

With this, PHPCS will validate all files in the current folder, one at a time.

Suggestions and error information should be treated separately.

Use the tool's options to revalidate code after modifications or ignore false positives.

## 6. Compiling the project's SCSS

The project uses GULP to compile SCSS.

gulp requires a configuration file to run, and that file is called gulpfile.js .

All of your SCSS should live inside the /assets/scss/ folder.

When running the command below, GULP will monitor the files in that folder in real time and will transform them into a CSS file that will be placed inside the /assets/css folder:

    gulp

If you want to stop monitoring just close bash or cancel the command with Ctrl + C