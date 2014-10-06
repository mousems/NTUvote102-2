NTUvote
=======

This Branch is for re-election of College of Social Science Student Representative.

Date: 2014/10/15 9:00~17:00

Introduction slide for the initial vote (2014/5/28): [http://goo.gl/dWmZF5](http://goo.gl/dWmZF5)

Note: NTUvote is under MIT License. please check LICENSE file.

How to setup NTUvote
=======

#### 2 LAMP servers

1. Vote Server: Provides web service and account authorization. Vote results are stored in `/var/log/NTUticket/`. System logs  without personal information are stored in `/var/log/NTUvote`.
2. Logger Server: Hashed Auth Code are stored in MySQL DB. A simple API is provided for Vote Server.

#### Setup Service 

Set up two servers with LAMP and enable SSL & AllowOverride in Apache.

##### Server 1:

`mkdir /var/log/NTUticket`

`mkdir /var/log/NTUvote`

##### Server 2:

`mkdir /var/log/NTUvote`

setup mysql and import SQL file

`mv host-config-sample.php host-config.php` and edit it.


#### Generate Auth. Code:

1. run `/var/www/tool/passgen.php` to generate random key.
2. edit `/var/www/tool/keygen.php` file and run this tool on Logger Server. It will hash all Auth Code and insert them into MySQL database.

All set and you're ready to vote!

#### contact
MouseMs < mousems.kuo [at] gmail.com >

## Building front-end assets

The built CSS and JS files are included in the repository. You won't need to run the following script unless the corresponding source code has changed.

```
bundle install
bower install
middleman build
```
