##Contents

This repository contains the following files:
1. The final version of my presentation slides (DEFCON-21-Chow-Abusing-NoSQL-Databases.pdf)
2. The source code of the web-based demos I presented (two PHP files)
3. A script to riddle a NoSQL database {Couch DB, Mongo, Redis} with junk (i.e., strings), illustrating the dynamic nature of the NoSQL data models: if a schema or record does not exist, it will be created automatically.

##Using the PHP scripts
* Database requirements: a connection to a Mongo database named `financials` with one collection named `news`.  The look of a document in `news`:
	`{ "_id" : ObjectId("51deafd5b8d78813e46dfa5e"), "screen_name" : "PandoDaily", "text" : "Joining the Dots: Betaworks' popular game is headed to Android http://t.co/s4bNuxYCmS", "created_at" : ISODate("2013-07-11T13:13:05Z"), "author_id" : 419710142, "id" : NumberLong("355313795914145792") }`
* PHP requirements: PECL and the MongoDB PHP driver.  See http://www.php.net/manual/en/mongo.installation.php for installation instructions.

##Using the "pollute" script
* Usage: `pollute-nosql.rb couchdb|mongo|redis host wordfile [value_for_each_key]`
* Example: `ruby pollute-nosql.rb mongo 192.168.39.128 /path/to/metasploit-framework/data/wordlists/unix_passwords.txt BOO`
* Explanation of example: Script will attempt to connect to MongoDB on host 192.168.39.128 on default port 27017. If successful, script will create new databases for each word in `unix_passwords.txt` with one document `{"BOO" => 1}`.
