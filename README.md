# Proovitoo

default username: user 

default password: Parool1

## Setup 

Clone project from github and move it to your webservers documentroot, usually (/var/www/html).

Create a new MySQL database.

Import database schema from anagram_db.sql.

``` mysql -u <your_db_username> -p <your_db_name> < anagram_db.sql```

In backend/config copy and rename ```template.config.inc.php``` to ```config.inc.php``` and change the database authentication credentials to match your database authentication credentials.

In the backend folder run ```composer update``` to install required PHP libraries and dependencies.

In the frontend folder rename ```.env.example``` to ```.env```.

Run ```npm i``` to install required Javascript libraries and dependencies.

Finally run ```npm start``` to start Reactjs development server.
