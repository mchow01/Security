function xorEncrypt(plaintext, password) {
	var xor = "";
	var blank = "0";
	for (var i = 0; i < plaintext.length; i++) {
		if (isNaN(password.charCodeAt(i))) {
			xor += String.fromCharCode(plaintext.charCodeAt(i) ^ blank.charCodeAt(0));
		}
		else {
			xor += String.fromCharCode(plaintext.charCodeAt(i) ^ password.charCodeAt(i));
		}
	}
	return (new Buffer(xor).toString('base64'));
}

// Express initialization
var express = require('express');
var app = express(express.logger());
app.use(express.bodyParser());
app.set('title', 'ScoreCenter');

// Mongo initialization
var mongoUri = process.env.MONGOLAB_URI || 
  process.env.MONGOHQ_URL || 
  'mongodb://localhost/scorecenter';
var mongo = require('mongodb');
var db = mongo.Db.connect(mongoUri, function (error, databaseConnection) {
	db = databaseConnection;
});

app.get('/', function(req, res) {
	res.set('Content-Type', 'text/html');
	var indexPage = '';
	db.collection('scores', function(er, collection) {
		collection.find().sort({score:-1}).limit(100).toArray(function(err, cursor) {
			if (!err) {
				indexPage += "<!DOCTYPE HTML><html><head><title>ScoreCenter</title></head><body><h1>ScoreCenter</h1><table><tr><th>User</th><th>Score</th></tr>";
				for (var count = 0; count < cursor.length; count++) {
					indexPage += "<tr><td>" + cursor[count].username + "</td><td>" + cursor[count].score + "</td></tr>";
				}
				indexPage += "</table></body></html>"
				res.send(indexPage);
			}
			else {
				res.send('<!DOCTYPE HTML><html><head><title>ScoreCenter</title></head><body><h1>Whoops, something went terribly wrong!</h1></body></html>');
			}
		});
	});
});

// http://stackoverflow.com/questions/5710358/how-to-get-post-query-in-express-node-js
app.post('/submit.json', function(req, res) {
	// Enabling CORS
	// See http://stackoverflow.com/questions/11181546/node-js-express-cross-domain-scripting
	res.header("Access-Control-Allow-Origin", "*");
	res.header("Access-Control-Allow-Headers", "X-Requested-With");
	
	var username = req.body.username;
	var score = parseInt(req.body.score);
	var toInsert = {"username":username,"score":score, "create_at":Date()};
	db.collection('scores', function(er, collection) {
		var id = collection.insert(toInsert, function(err, saved) {
			if (err) {
				res.send("Whoops, something went terribly wrong...")
			}
			else if (!saved) {
				res.send("Whoops, data was not saved...");
			}
			else {
				var theFlag = 'key{b6aad70c354323ec2c09f3bb2fae75da7eb64776}';
				res.send(xorEncrypt(theFlag, saved[0]["score"].toString()));
			}
		});
	});
});

app.get('/scores.json', function(req, res) {	
	// Enabling CORS
	// See http://stackoverflow.com/questions/11181546/node-js-express-cross-domain-scripting
	res.header("Access-Control-Allow-Origin", "*");
	res.header("Access-Control-Allow-Headers", "X-Requested-With");
	db.collection('scores', function(er, collection) {
		collection.find().sort({score:-1}).limit(10).toArray(function(err, docs) {
			res.send(JSON.stringify(docs));
		});
	});
});

// Oh joy! http://stackoverflow.com/questions/15693192/heroku-node-js-error-web-process-failed-to-bind-to-port-within-60-seconds-of
app.listen(process.env.PORT || 5000);
