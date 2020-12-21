[![Build Status](https://travis-ci.com/hellemarck/ramverk1-project.svg?branch=main)](https://travis-ci.com/hellemarck/ramverk1-project)
[![Build Status](https://scrutinizer-ci.com/g/hellemarck/ramverk1-project/badges/build.png?b=main)](https://scrutinizer-ci.com/g/hellemarck/ramverk1-project/build-status/main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hellemarck/ramverk1-project/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/hellemarck/ramverk1-project/?branch=main)


# Project in the course Ramverk1, BTH 2020.
Built in PHP with the framework Anax and database SQLite.

### Download and install

`git clone https://github.com/hellemarck/ramverk1-project.git`

`composer install`

`make install`

`make install test`

### Create the database

`chmod 777 data`

`sqlite3 data/db.sqlite`

`chmod 666 data/db.sqlite`

`sqlite3 data/db.sqlite < sql/ddl/all_sqlite.sql`

Now create a user, update user settings with an email address to get a gravatar picture, and post the first forum question!
