DomainToad ReadMe
=====================


This is the source code for [http://domaintoad.com][1]. It's distributed under GPL3 license.

----------


Getting Started
---------

The code for DomainToad is written in PHP/MySql and uses the MagpieRSS library. You should be comfortable working with and editing PHP, working with MySql, and editing html/css.

> **NOTE:**
> This code is old. I wrote it a long time ago and it is bad from an architecture standpoint. Code and designed are mixed together. Sorry in advance.


####  The Database

The database schema for MySql is dbschema.sql. Simply import that into your MySql database to get started.

You will also need to edit dbconnection.php and change the username, password and database variables.

#### Feeds and Updating Data

You will need to set a cron job to execute feedloader.php however often you want to check for new posts. Depending on your version of PHP, you should be able to call **php /path/to/feedloader.php** for your cron job.

In the database, you will need to have added sources in the **sources** table. The columns are labeled pretty self explanatorily.

 - rssFeedURL - the full URL for the RSS feed
 - blogTitle - the name of the blog
 - blogLink - a link to the blog
 - imageURL - the full URL to a logo for the blog
 
Other fields will get setup automatically.

#### <i class="icon-pencil"></i> Editing The Site

Sorry. This is going to suck.

siteinfo.php has a few of the key variables such as $siteName, $websiteAddress.

Index.php has a lot of the design mixed into the code. You will probably need to go through it and change things there.

The widgets (widget.js / widgetheadlines.js) both have settings in the top to make them work.



----------


Other Thoughts
---------------

Again. Sorry for the code quality not being great. DomainToad was written a long time ago and I only spent a day playing with it to challenge myself. If I could do it again, it would look a lot different with code separation, using PDO instead of mysql_real_escape_string and a lot of other changes.

  [1]: http://domaintoad.com
