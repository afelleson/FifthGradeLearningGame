# The VASA-Wiggin Street Fifth Grade Learning Game
<h2 align="center">VASA-Wiggin Space Dash — overview</h2>

- 🚀 VASA-Wiggin Space Dash combines a 3D running and dodging game with multiple choice questions and hangman-style word guessing. 
- 📕 It uses questions and words from the standardized Ohio fifth-grade cirriculum and was designed for a class of fifth graders to play on their school-provided laptops. 
- 🔑 Login information can be managed by anyone with access to the linked MySQL database.
- 🏆 The database is also used to log users' score tallies for display on a leaderboard page.
- 📝 Questions, answers, words, and hints are currently stored as arrays in [index.php](GameDemo/index.php) and can be edited there.
 - 💻 Installation on your own server requires PHP, MariaDB or MySQL, and a web server (e.g., Apache).

<h2 align="center">About the project and the development team</h2>
<h3 align="center">Hi 👋, we are Alex, Asmod, Saurav and Viet.</h3>

- 🔭 We originally built [The VASA-Wiggin Street Learning Game](https://github.com/khakurel1/LearningGame1) in the spring of 2022 for our Software and System Design class at Kenyon College. 

- 📚 The purpose of this assignment was to perform the entire software engineering process in a single semester, from initial design and requirements documentation, to iterative development and user testing, to a final product that satisfied the users. 

- 🧑‍🏫 Our users were a class of local fifth grade students at Wiggin Street Elementary School in need of a fun way to prepare for their standardized tests. They helped us design, test, and improve the game every couple weeks throughout the semester. 

- 👾 We used code from [spacecraft by tricsi](https://github.com/tricsi/spacecraft) as the starting point for our game so we could focus on the educational and competitive components of the design in the limited time we had. 

- ✨ This updated repository includes changes Alex made in 2024: cleaning up our old files, fixing issues, adding missing files, and writing installation instructions. 🛠 

- 📫 Connect with us:
    - Alex (<a href="https://github.com/afelleson">afelleson </a><a href="https://github.com/afelleson" target="blank"><img align="bottom" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fpngimg.com%2Fuploads%2Fgithub%2Fgithub_PNG28.png&f=1&nofb=1&ipt=0348b6f2b71bdb078859cb3a33418832cd6443b0a199edb44558f271fee124d1&ipo=images" alt="github" height="15" width="15" /></a>): <a href="https://www.linkedin.com/in/alex-felleson/" target="blank"><img align="bottom" src="https://raw.githubusercontent.com/dheereshagrwal/colored-icons/f7e587a482aafa9b290d1f757ab0060128f4ff0a/public/icons/linkedin/linkedin.svg" alt="linkedin" height="20" width="20" /></a>
    - Asmod (<a href="https://github.com/khakurel1">khakurel1 </a><a href="https://github.com/khakurel1" target="blank"><img align="bottom" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fpngimg.com%2Fuploads%2Fgithub%2Fgithub_PNG28.png&f=1&nofb=1&ipt=0348b6f2b71bdb078859cb3a33418832cd6443b0a199edb44558f271fee124d1&ipo=images" alt="github" height="15" width="15" /></a>): khakurel1@kenyon.edu <a href="https://www.hackerrank.com/khakurel1" target="blank"><img align="bottom" src="https://raw.githubusercontent.com/rahuldkjain/github-profile-readme-generator/master/src/images/icons/Social/hackerrank.svg" alt="hackerrank" height="20" width="20" /></a>
    - Saurav (<a href="https://github.com/sauravpandey123">sauravpandey123 </a><a href="https://github.com/sauravpandey123" target="blank"><img align="bottom" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fpngimg.com%2Fuploads%2Fgithub%2Fgithub_PNG28.png&f=1&nofb=1&ipt=0348b6f2b71bdb078859cb3a33418832cd6443b0a199edb44558f271fee124d1&ipo=images" alt="github" height="15" width="15" /></a>)
    - Viet: dang1@kenyon.edu
</p>

<h2 align="center">Languages and tools:</h2>

<p align="center">We developed this game using git, SQL, PHP, JavaScript, CSS, HTML, and Linux shell commands.</p>

<p align="center">  
<a href="https://git-scm.com/" target="_blank" rel="noreferrer"> <img src="https://www.vectorlogo.zone/logos/git-scm/git-scm-icon.svg" alt="git" width="40" height="40"/> </a> 
<a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/gilbarbara/logos/52addcaa18dfecb4df77f3ee0753dca6b98187ad/logos/mysql.svg" alt="mysql" width="40" height="40"/> </a> 
<a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a> 
<a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="javascript" width="40" height="40"/> </a> 
<a href="https://www.w3schools.com/css/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original-wordmark.svg" alt="css3" width="40" height="40"/> </a> 
<a href="https://www.w3.org/html/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original-wordmark.svg" alt="html5" width="40" height="40"/> </a> 
<a href="https://www.linux.org/" target="_blank" rel="noreferrer"> <img src="https://pluspng.com/img-png/linux-logo-png-brand-brands-linux-logo-logos-icon-512x512.png" alt="linux" width="40" height="40"/> </a> 
 </p>

<h2 align="center">How to install the game on your own server:</h2>

<h3 align="left">Working entirely on the Linux machine (virtual machine or local device) you want to serve the website from:</h3> 

(We used an Ubuntu server.)

1. <a href="https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-22-04#step-3-installing-php">Set up  Apache, PHP, and MySQL</a> (or <a href="https://www.digitalocean.com/community/tutorials/how-to-install-mariadb-on-ubuntu-22-04"> MariaDB</a>) on your server.
2. Move to the directory you'd like to clone this repository in.
3. Clone this repository and move into its root directory:
    ```shell
    git clone git@github.com:afelleson/FifthGradeLearningGame.git;
    cd FifthGradeLearningGame;
    ``` 
4. Create a web directory for the game and make your current user its owner. Also create a private directory to hold files containing sensitive information like your MySQL/MariaDB password:
    ```shell
    sudo mkdir /var/www/html/LearningGame/;
    sudo chown $USER /var/www/html/LearningGame;
    sudo mkdir /etc/LearningGame/;
    sudo chown $USER /etc/LearningGame/;
    ```
    Note: If you want to call this directory something else, you'll have to find and replace '/etc/LearningGame/' with the path to your directory in all the files in the [GameDemo](GameDemo/) folder. Also, use your new directory name in the final two steps on this list.

5. Copy all the [GameDemo](GameDemo/) files into your web directory. Copy [config.php](config.php) into your private directory.
    ```shell
    cp -r GameDemo/* /var/www/html/LearningGame;
    cp config.php /etc/LearningGame;
    ```
6. Replace our placeholder database password with your own:
    ```shell
    find /etc/LearningGame -name config.php -exec sed -i "s/\*\*\*/YourPassword/g" {} \;
    ```
7. If you aren't using the root user for MySQL/MariaDB, replace the default database username with your own in [config.php](config.php) and [Game1.sql](Game1.sql). If you are not hosting your database on the same server as the one you created the web directory on, replace the database host too:
    ```shell
    find /etc/LearningGame -name config.php -exec sed -i "s/root/YourUsername/g" {} \;
    sed -i "s/root/YourUsername/g" Game1.sql;

    find /etc/LearningGame -name config.php -exec sed -i "s/localhost/YourDatabaseHost/g" {} \;
    sed -i "s/localhost/YourDatabaseHost/g" Game1.sql;
    ```
8. By default, the database for this project will be called Game1. If you want to call it something else, make the appropriate replacements:
    ```shell
    find /etc/LearningGame -name config.php -exec sed -i "s/Game1/NewDatabaseName/g" {} \;
    sed -i "s/Game1/NewDatabaseName/g" Game1.sql;
    ```
9. Create a database called Game1 (or your own name) and import Game1.sql:
    ```shell
    mysql -u YourUsername -p -e "CREATE DATABASE IF NOT EXISTS Game1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

    mysql -u YourUsername -p Game1 < Game1.sql;
    ```
    Or, if your database is not hosted on the server you're running these commands on:
    ```shell 
    mysql -h YourDatabaseHostName -u YourUsername -p Game1 < Game1.sql;
    ```
10. Make the web server the only user with read permissions on the config file:
    ```shell
    sudo chown www-data:www-data /etc/LearningGame/config.php;
    sudo chmod 600 /etc/LearningGame/config.php;
    ```
11. View and play the game online at YourServerAddress/LearningGame

<h3 align="left">If you'd rather clone this repository on your local machine, edit the files there, and copy them onto a remote server or virtual machine to avoid the command line as much as possible:</h3> 

Terminology: Remote machine = virtual machine = VM = server = remote server. 

We used an Ubuntu virtual machine to serve our website, and we accessed it via SSH. The file paths here assume your local machine is a Unix-like system. 

1. <a href="https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-22-04#step-3-installing-php">Set up  Apache, PHP, and MySQL</a> (or <a href="https://www.digitalocean.com/community/tutorials/how-to-install-mariadb-on-ubuntu-22-04"> MariaDB</a>) on your remote system. <a href="https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-22-04">Also set up phpMyAdmin</a>. <a href="https://cs.kenyon.edu/index.php/install-mariadb-and-phpmyadmin/">
Here's another set of instructions for MariaDB and phpMyAdmin</a>.
2. Clone this repository to your local machine. Then cd into the local directory for the repository.
    ```shell
    git clone git@github.com:afelleson/FifthGradeLearningGame.git;
    cd FifthGradeLearningGame;
    ```
3. Import the Game1.sql database using phpMyAdmin.
    1. Visit phpMyAdmin at http://00.000.00.000/phpMyAdmin/, replacing http://00.000.00.000 with your server address.
    2. Log in using the username and password you set up for MySQL/MariaDB. If you are not using the root user, edit the Game1.sql file to include your username instead of 'root' in the events section.
    3. Click 'New' on the left, or navigate to http://00.000.00.000/phpMyAdmin/index.php?route=/server/databases.
    4. In the 'Database name' field, type 'Game1.' (If you want to call it something else, do a find-and-replace in the entire repository clone to change Game1 to your new database name.)
    5. Click the 'Import' tab at the top.
    6. Import the Game1.sql file from your local clone of this repository. You can leave all the import options at their defaults. Scroll down and click 'Import.'
    7. **Add new users by inserting rows into the LoginCreds database at any time.**
 4. Create a web directory for the game and make your current user its owner by running the following in your VM shell. Also create a private directory to hold files containing sensitive information like your MySQL/MariaDB password:
    ```shell
    sudo mkdir /var/www/html/LearningGame/;
    sudo chown $USER /var/www/html/LearningGame;

    sudo mkdir /etc/LearningGame/;
    sudo chown $USER /etc/LearningGame/;
    ```
    Note: If you want to call this directory something else, you'll have to find and replace '/etc/LearningGame/' with the path to your directory in all the files in the GameDemo folder. 

5. Copy the necessary files into your web directory: **On your local computer (within the repo directory),** run the following, replacing the IP address (and username, if not ubuntu) with your own.
    ```shell
    scp -r GameDemo/* ubuntu@00.000.00.000:/var/www/html/LearningGame;
    ```
    Troubleshooting: If you get ```Permission denied (publickey)```, you need to log out from your remote machine (run ```logout```) or open a new, local shell session in another tab.
6. Copy the config file into your virtual machine, but store it outside of the web directory for added security:
    ```shell
    scp config.php ubuntu@00.000.00.000:/etc/LearningGame;
    ```
7. If you would prefer to add your MySQL/MariaDB username and password to [config.php](config.php) by manually editing the file on your local device, do that now. Otherwise, you can do this by running ```sed``` commands: 
    ```shell
    find /etc/LearningGame -name config.php -exec sed -i "s/\*\*\*/YourDatabasePassword/g" {} \;
    find /etc/LearningGame -name config.php -exec sed -i "s/root/YourDatabaseUsername/g" {} \;
    ```
    You may also need to replace the database host if the database is not hosted by the same IP you're serving the web directory from. (That would mean you set up MySQL/MariaDB on another server.)
    ```shell
    find /var/www/html/LearningGame -name config.php -exec sed -i "s/localhost/YourDatabaseHostIP/g" {} \;
    ```
    If you replaced the username and/or database host here, you may need to also adjust the events in the Game1 database in phpMyAdmin to reflect that. (You could do that by editing the Game1.sql file and re-importing it.)
8. Make the web server the only user with read permissions on the config file:
    ```shell
    sudo chown www-data:www-data /etc/LearningGame/config.php;
    sudo chmod 600 /etc/LearningGame/config.php;
    ```
9. View and play the game online at YourServerAddress/LearningGame

<h3>Summary of things you might want to change, their existing values, and where to find-and-replace them:</h3> 

- The username on the remote machine (ubuntu) 
    - Shell commands provided in the setup instructions for a locally-cloned repository with a remote server. 
- SQL database host (localhost — the system hosting the web directory) 
    - [config.php](config.php) 
    - [Game1.sql](Game1.sql) 
    - Database creation and import instructions in the server-only instructions
- MySQL/MariaDB database username (root) 
    - [config.php](config.php) 
    - [Game1.sql](Game1.sql) 
    - Database creation and import instructions
- Your MySQL/MariaDB password (***)
    - [config.php](config.php) 
- The game's directory name (LearningGame)
    - All files in [GameDemo](GameDemo/)
    - Paths in the instructions' shell commands
