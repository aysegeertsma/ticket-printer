# Docker development environment
This enviroment is based on shincoder/homestead:php7.1. Details can be
found on the docker-hub or in the HomesteadREADME.md

## getting started quickly
You should be familiar with docker and docker-compose. At least install them. I'd advice to read up on
<https://docs.docker.com/compose/completion/> because command completion is a great gift.

To start the docker container go to the root of this project (where the file ```docker-compose.yml``` resides) and use this command in a terminal:
```bash
docker-compose up -d
```
This command will start the MySQL server and the laravel webserver. The webserver contains PHP and NGINX. More
servers/services might be added later.

The server will now download and start. To turn the server off later, use 
```bash
docker-compose down
```
### Trouble starting the containers?
If you run into trouble starting the docker containers, first stop them (```docker-compose down```) and then start them
without the ```-d``` option:
```bash
docker-compose up
```
This will run the servers in normal mode and not on the background. It will output all messages from 
start.

## Setting up an app
### Setting access rights
Just to be sure, set your access rights to the apps and the volumes folders. You might have to do this
more often in the future. 
Run these commands from the project root:
```bash
 sudo chmod -R 777 volumes
```
```bash
 sudo chmod -R 777 apps
```
This part of the manual needs editing!
### Connect to the webserver
To set up an app you must connect to the webserver. There are two ways to do this: over ssh and using
docker directly. The first method is more flexible.
#### SSH
Use this command to connect to the started webserver:
```bash
ssh homestead@127.0.0.1 -p2222
```
The password for the user ```homestead``` is ```secret```. The user is a member of the sudo group so 
to you are allowed to use sudo to perform certain tasks.

#### Using docker exec
```bash
docker exec -ti ticketprinter-homestead
```
Where _ticketprinter-homestead_ is the servername. It might change over time. ```bash``` is the command we
execute. We can put any command we want there.
Remember: if you use docker exec the command will always be executed as root for the container. 
### Create a new project
After you are logged in to the webserver go to the /apps folder: ```cd /apps```
To start a new laravel project use the command:
```bash
composer create-project --prefer-dist laravel/laravel my-shiny-project
```
Where _my-shiny-project_ is your project name. Choose a name that suits yout needs.
### Get an existing project
Go to the /apps folder ```cd /apps``` and clone the existing project. For example:
```bash
git clone git@github.com:user/someproject.git
```
You might not have the ssh keys or access rights for the repository. You can put your source code in
the apps folder any way you like. On my dev machine for example I use the git commands on the host and not on the
docker client.
The structure of your project **on the host** should look something like this:
```
.
+--apps
|  +--my-test-project
|  +--my-project
|     +--app
|     +--arisan
|     ...
|     +--public
|     ...
1.11..
|
+---docker-compose.yml
+---volumes
|
...
```
### Setting up the vhost
If your project is ready, log in to the client webserver and go to the root folder ```cd /```. In the root run
```bash
 sudo ./serve.sh my-shiny-project.dev.local /apps/my-shiny-project/public
```
Where _my-shiny-project.dev.local_ is your host name and _/apps/my-shiny-project/public_ is your project public folder. 

**TIP: use tab completion to find folders.** <https://www.quora.com/How-does-command-line-completion-work>

If you run multiple apps, please make sure to add your host names to the host files on both the host and the client:
<https://www.howtogeek.com/howto/27350/beginner-geek-how-to-edit-your-hosts-file/>

Finally you can go to <http://127.0.0.1:8000> or <http://my-shiny-project.dev.local:8000> or any hostname you've chosen. You probably will get 
a lot of errors because we haven't set up anything.

### Things to do next
The first errors might be because laravel does not have all it's dependencies installed. To do so, go to the
app folder on the client ```cd /apps/my-shiny-project``` and run ```composer install```. See laravel documentation for further help.

Second you should set up your database. The credentials can be found in the ```docker-compose.yml``` file.
```yml
mysql:
    image: mysql:5.7
    volumes:
      - ./conf/mysql.cnf:/etc/mysql/conf.d/custom.cnf
      - ./volumes/mysql:/var/lib/mysql
    environment:
      - "MYSQL_ROOT_PASSWORD=KyvgJWlVrZYIAvW4ukU9XQnoIoC7H14x1mS9H4Bp7iT0svmpqqGEXLPjeVxxsX3k"
      - "MYSQL_DATABASE=kpidb"
      - "MYSQL_USER=adriaanse"
      - "MYSQL_PASSWORD=adriaanse1990"
    ports:
      - "3306:3306"
```
You can change the setting but you might have to delete your database to make it work. I suggest for now you
add these settings to the laravel config. Then, if you have to run migrations and such.
## Connecting to the database
The default mysql port for the client is exposed to the host. You can use any tool to connect to the mysql server.
Personally I prefer MySQL workbench <https://dev.mysql.com/downloads/workbench/> but there are a lot of tools out there.
Use it to make extra users and databases as much as you like.
If you need access to the database you can connect to port 3306. The port is defined in the ```docker-compose.yml``` file in the section for the mysql server.
```yml
    ports:
      - "3306:3306"
```
Port 8000 is defined in the same way for the webserver:
```yml
    ports:
        - "8008:8008" #experiment
        - "8000:80" # web
        - "2222:22" # ssh
```
If you ever run into trouble with ports, feel free to change these ports. The syntax for mapping ports is:
```
		- "hostport:clientport"
```
So, if for example port 3306 is taken on your host, change the mysql block in ```docker-compose.yml``` into:
```yml
    ports:
      - "8306:3306"
```
Restart you docker containers ```docker-compose down && docker-compose up -d``` and your mysql will be available at port ```8306```.

## Adding components/changing install
Every time the server is build the file ```./docker-support/ticket-printer-provision.sh``` is executed. You can add 
any command you like but before you do check it in the running container and **make sure the command
runs without user interaction.** So... use
```bash
apt-get update -y
apt-get install -y some-package
```
And not
```bash
apt-get update 
apt-get install some-package
```
becausse it requires user interaction. You can test your commands fist by logging into the running server using ```docker exec``` (see above) and 
just execute whatever you want. The changes will disappear when you stop and start the container(s). Add the commands to ```docker-support/ticket-printer-provision.sh``` to
make them permanent.

After you (or one of the team) make changes to the setup you should run
```
docker-compose up -d --build
```
The ```--build``` option makes sure the container uses a freshly build image.
