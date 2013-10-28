#Overview
This was the Capture The Flags game for my Introduction to Security class at Tufts University, fall 2013 semester.

#Requirements
A web server with:
1. PHP
2. MySQL

#Setup
1. Copy all the files in the `www` directory to the public HTML folder of your web server.
2. Create database, database tables, and data to MySQL using the `database/initial_data.sql` file (e.g., `mysql -u root -p < initial_data.data`)
3. Create user account on server `pheller:baseball`. Compile `runme.c` (found in `src`) in the user's account using the Makefile and then delete the Makefile and `runme.c`
4. (optional) Set up the scoreboard for CTF game using files in `scoreboard` on a different server.

#Vulnerabilities Found In This Game
1. SQL injection
2. Cross-site scripting
3. Password cracking
4. Command injection
5. Cookie tampering
