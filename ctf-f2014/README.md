#Overview
This was the Capture The Flags game for my Introduction to Security class at Tufts University, fall 2014 semester.

#Requirements
A web server with:
1. PHP
2. MySQL

#Setup
1. Copy all the files in the `www` directory to the public HTML folder of your web server.
2. Create database, database tables, and data for `board` (WordPress and message board) to MySQL using the `database/initial_data.sql` file (e.g., `mysql -u root -p < initial_data.sql`)
3. Create database, database tables, and data for `scoreboard` to MySQL using the `database/scoreboard-final.sql` file (e.g., `mysql -u root -p < scoreboard-final.sql`)