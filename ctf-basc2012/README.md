##Overview

These are the files for the CTF game that I ran at the OWASP Boston Application Security Conference (BASC) on Saturday, October 13, 2012 at Microsoft NERD.  The presentation given at the conclusion of the conference and the final MySQL database dump from the CTF server are in the `docs` and `sql` folders respectively.

##To Recreate the Game

To recreate the game on your own server, you will need a LAMP-based web server with PHP and MySQL installed.

###Instructions

1. Add a new user account on the server: username `lrrr` and set the password to `Hum@nH0rn`.  Make sure the user have its own home directory (e.g., `/home/lrrr`).
  * Run: `mkdir /home/lrrr ; useradd lrrr -d /home/lrrr ; passwd lrrr`
2. Compile the `runme.c` with the provided Makefile (both files in `src`) and put the resulting executable in the user lrrr's home directory.  Be sure to change the owner and group of the executable to lrrr.
  * Run: `make ; mv runme /home/lrrr ; cd /home/lrrr ; chown lrrr runme ; chgrp lrrr runme;`
3. Put all the files in the `www` directory to the `www` directory on your server (e.g., `/var/www`).
4. Import the MySQL database (via `dump_20121014.sql` in the `sql` folder) to your server.
  * Run: `mysql -u root -p < dump_20121014.sql`
5. Add the line `;FLAG: "Sinners and saints"` to the `php.ini` file (anywhere in the file) on your server (e.g., `/etc/php5/apache2/php.ini`).
6. Create the file `FLAG.txt` in the `www` directory. Make the content of the file: `FLAG: "Witch and wardrobe"`.
7. Create the file `FLAG.txt` in the root directory `/`. Make the content of the file: `FLAG: "Chaos and creation"`.

Happy hacking!
