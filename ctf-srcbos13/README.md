# Overview
This is an HTML5 game called _Not Global Thermal Nuclear War_.  The game connects to a high scores game server.

# Software Requirements
* Node.js (for high scores game server)
* Mongo DB (for the database of high scores)

# Setup (locally)
1. Put the directory `ngtnw` into the root directory on some web server (e.g., in a `/var/www` directory). The directory `ngtnw` contains the entire HTML5 game client.
2. Turn on Mongo DB daemon via `mongod` (and keep it running)
3. Turn on high scores game server via `node /path/to/scorecenter/server.js` (and keep it running)

Note: `ngtnw` and `scorecenter` can be put on different web servers or VMs.  If `scorecenter` is put onto a different web server, the URI `http://localhost:5000` must be changed to proper location in `ngtnw/game.js`.

# To Play the Game 
Go to `http://localhost:5000/ngtnw/` on a web browser that supports HTML5 and local storage.

# About the Flag
Upon score submission high scores server, the flag is XORed with your high score as a string.  Remaining characters of flag are XORed with "0".  Then, the result is encoded to Base64, and sent back to client to be stored into local storage.

For players to get the flag, the entire process described above must be reversed...

# Acknowledgement
I want to thank Zach Lanier (quine) for his help on this challenge.
