NTUvote
=======

This Branch is for Re-voting of Student Representatives from the College of Social Science.

Date:2014/10/15 9:00~17:00


Introduction slide for 2014/5/28 first NTUvote: [http://goo.gl/dWmZF5](http://goo.gl/dWmZF5)

note: NTUvote is under MIT license , please check LICENSE file.

How to setup NTUvote
=======

#### 2 LAMP servers.

1. Vote Server : provide web service and account authorization. Vote result store in /var/log/NTUticket/ . System log without personal information store in /var/log/NTUvote .
2. Logger Server : Auth. Code's Hash store in MySQL DB , provide a simple API for Vote Server to call to.

#### Setup Service 

Set up two servers with LAMP and enable SSL & AllowOverride in Apache.

##### Server 1:

mkdir /var/log/NTUticket

mkdir /var/log/NTUvote

apt-get install git
cd /var/log/NTUticket
git init

##### Server 2:

mkdir /var/log/NTUvote

setup mysql and import SQL file

mv host-config-sample.php host-config.php and edit it.


#### Generate Auth. Code:

1. run /var/www/tool/passgen.php to generate random key.
2. edit /var/www/tool/keygen.php file and run this tool on Logger Server. It will hash all Auth. Code and then insert into MySQL.

ready to vote!

#### contact
MouseMs < mousems.kuo [at] gmail.com >

## Building front-end assets

The builded css and js files are included the repository. You won't need to run the following, unless the source code is changed.

```
bundle install
bower install
middleman build
```