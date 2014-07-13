#To play: installation
1. Install LAMP server
2. Install MongoDB
3. Install PHP-Mongo driver: http://www.php.net/manual/en/mongo.installation.php#mongo.installation.nix
4. See this on getting the PHP-Mongo driver working: http://stackoverflow.com/questions/22952994/mongo-so-undefined-symbol-php-json-encode-in-unknown-on-line-0-after-instal
5. Unzip `mongo_data.zip` and move files (`financials*`) to MongoDB data directory (e.g., `/usr/local/var/mongodb`) to the MongoDB data directory
6. Move the files in the ~/www in the VM to the `www` folder
7. Change one of the text records in the `news` collection of the `financials` database to `JPDmAg7j7IFfQb1oSv4k`

#The big idea of this challenge
MongoDB injection

##Additional references on this challenge
* http://www.acunetix.com/vulnerabilities/mongodb-injection/
* https://www.idontplaydarts.com/2010/07/mongodb-is-vulnerable-to-sql-injection-in-php-at-least/
* https://gist.github.com/mchow01/49f8979829f1c488d922

##Example attack
`http://192.168.1.4/?searchbox[$ne]=CBSNews`

##But that's not all!
Dump all the records from the database to get a key `JPDmAg7j7IFfQb1oSv4k`.  Use that key to unlock flag in image `b.jpg` on website.  Notice there are two different images on the website: `a.jpg` and `b.jpg` --they look the same but `b.jpg` has a message inside of it.  Use `steghide` and the key to get the flag.  The key is `key{ece161ad20027219789c00e26ed2eaa31907b8f9}`

##Addendum
This type of vulnerability was recently seen in the FireEye Malware Analysis System, http://pastebin.com/JiQ7F5nE