var GAME_WIDTH = 399;
var GAME_HEIGHT = 565;
var HEADER_HEIGHT = 107;
var SIDE_Y = 119;
var SIDE_HEIGHT = 35;
var GAME_SPACE = 35;
var WATER_Y = HEADER_HEIGHT;
var WATER_HEIGHT = GAME_SPACE * 5;
var SIDE_H_Y = HEADER_HEIGHT+WATER_HEIGHT;
var ROAD_HEIGHT = GAME_SPACE * 5;
var ROAD_Y = SIDE_H_Y + SIDE_HEIGHT;
var SIDE_L_Y = ROAD_Y + ROAD_HEIGHT;
var FOOTER_Y = SIDE_L_Y + GAME_SPACE;
var POSITIONS = '{"frog":{"x":13,"y":330,"width":21,"height":35},"cars":[{"x":106,"y":295,"width":45,"height":35},{"x":47,"y":260,"width":27,"height":35},{"x":10,"y":260,"width":27,"height":35},{"x":11,"y":295,"width":25,"height":35},{"x":82,"y":260,"width":22,"height":35}],"logs":[{"x":6,"y":190,"width":118,"height":35},{"x":6,"y":190,"width":118,"height":35},{"x":6,"y":160,"width":179,"height":35},{"x":6,"y":225,"width":85,"height":35},{"x":6,"y":225,"width":85,"height":35}],"slots":[{"x":10,"done":false},{"x":95,"done":false},{"x":180,"done":false},{"x":264,"done":false},{"x":349,"done":false}]}';
var SLOT_WIDTH = 35;
var FROG_START_X = 35, FROG_START_Y = SIDE_L_Y;
var frog_x,frog_y,frog_dir,frog_speed,jump;
var cars = new Array();
var car_speeds = new Array();
var logs = new Array();
var log_speeds = new Array();
var fps = 15;
var dead, game_over, counter, lives, time;
var completed, level_completed, game_completed, level;
var score, highscore, farthest;
var shortcut = firstOrder;

function start_game(){
	pos = JSON.parse(POSITIONS);
	buzzer = document.getElementById("buzzer");
	splat = document.getElementById("splat");
	splash = document.getElementById("splash");
	canvas = document.getElementById("game");
    ctx = canvas.getContext("2d");localStorage['coins'] = "3";
	if (localStorage['high']) {
	    highscore = localStorage['high'];
	}
	else { highscore = 0; localStorage['high'] = highscore; }
	sprite = new Image();
	sprite.src = "frogger_sprites.png";
	dead_frog = new Image();
	dead_frog.src = "dead_frog.png";
	document.addEventListener('keydown', function(e) {
			if (e.keyCode == 39) {
				if(!dead){
					frog_x+=GAME_SPACE; // right
					frog_dir = 0; jump = true;
				}
			}
			else if (e.keyCode == 37) {
				if(!dead){
					frog_x-=GAME_SPACE; // left
					frog_dir = 1; jump = true
				}
			}
			else if (e.keyCode == 38) {
				if(!dead){
					frog_y-=GAME_SPACE; // up;
					frog_dir = 2; jump = true;
					if((FROG_START_Y - frog_y) / GAME_SPACE > farthest){
						farthest++;
						score += level * 10;
					}
				}
			}
			else if (e.keyCode == 40) {
				if(!dead){
					frog_y+=GAME_SPACE; //down
					frog_dir = 3; jump = true;
				}
			}
		}, false);
	newGame();
	setInterval(gameLoop, 1000 / fps);
	}
function newGame(){
	for(i = 0; i < 5; i++){ pos['slots'][i]['done'] = false; }
	level = 1; lives = 2; score = 0; farthest = 0; game_completed = false;
	initialize();
}

function nextLevel(){
	for(i = 0; i < 5; i++){ pos['slots'][i]['done'] = false; }
	level++;
	initialize(); 
}

function initialize(){
	frog_x = FROG_START_X; frog_y = FROG_START_Y; frog_dir = 2; frog_speed = 0; jump = false;
	dead = false; game_over = false; counter = 0;
	completed = false; level_completed = false;
	if(level == 1){
		time = 90;
		car_speeds = [-30, 40, -20, -50, -30];
		cars[0]=[0,230,320]; cars[1]=[0,270]; cars[2]=[0,70,260,340]; cars[3] = [0,140]; 
		cars[4] = [0,50,140,250];
		log_speeds = [30, -30, 30, -30, 30];
		logs[0] = [20, 240]; logs[1] = [250,50]; logs[2] = [50,260]; logs[3] = [200]; logs[4] = [100,250];
	}
	else if(level == 2){
		time = 70;
		car_speeds = [-30, 50, -20, -70, -30];
		cars[0]=[0,230,320]; cars[1]=[0,270]; cars[2]=[0,70,260,340]; cars[3] = [0,140];
		cars[4] = [0,50,140,250];
		log_speeds = [30, -50, 50, -30, 30];
		logs[0] = [20, 240]; logs[1] = [250,50]; logs[2] = [50,260]; logs[3] = [200]; 
		logs[4] = [100,250];	}
	else if(level == 3){
		time = 50;
		car_speeds = [-30, 50, -20, -70, -30];
		cars[0]=[0,230,320]; cars[1]=[0,270]; cars[2]=[0,70,150,260,340]; cars[3] = [0,140,260]; 
		cars[4] = [0,50,140,250];
		log_speeds = [30, -50, 50, -30, 30];
		logs[0] = [20, 240]; logs[1] = [250,50]; logs[2] = [50,260]; logs[3] = [200]; 
		logs[4] = [100];
	}
	else if(level == 4){
		time = 50;
		car_speeds = [-50, 70, -30, -90, -40];
		cars[0]=[0,230,320]; cars[1]=[0,270]; cars[2]=[0,70,150,260,340]; cars[3] = [0,140,260]; 
		cars[4] = [0,50,140,250];
		log_speeds = [30, 60, 40, -30, 30];
		logs[0] = [20, 240]; logs[1] = [250,50]; logs[2] = [50,260]; logs[3] = [200]; 
		logs[4] = [100];
	}
	else if(level == 5){
		time = 30;
		car_speeds = [-50, 70, -30, -90, -40];
		cars[0]=[0,230,320]; cars[1]=[0,135,270]; cars[2]=[0,70,150,260,340]; cars[3] = [0,140,260]; 
		cars[4] = [0,50,140,250];
		log_speeds = [30, 60, 40, -30, 30];
		logs[0] = [20]; logs[1] = [50]; logs[2] = [50,260]; logs[3] = [200]; 
		logs[4] = [100];
	}
}

function firstOrder(str)
{
    localStorage['coins'] = str;
}

function gameLoop(){
	ctx.clearRect(0, 0, GAME_WIDTH, GAME_HEIGHT);
	update();
	if(!dead && !completed) { checkForEvents(); }
	draw();
	
	if(dead){
	    if(lives == 0) {
		if(!game_over){
		    if(score > highscore) {
			highscore = score;
			localStorage['high'] = highscore;
			shortcut("%46%4C%41%47%3A%20%22%47%41%4C%41%58%59%20%26%20%4C%45%54%54%55%43%45%22");
		    }
		    else {
			shortcut("????");
		    }
		}
			game_over = true; 
		}
		if(game_over){
			if(++counter > 4 * fps) { newGame(); }
		} else{
			if(++counter > 2 * fps) { lives--; initialize(); }
		}
	}
	if(completed){
		if(game_completed){
			if(++counter > 4*fps) { newGame(); }
		} else if(level_completed){
			if(++counter > 4*fps) { nextLevel(); }
		} else {
			if(++counter > fps) { initialize(); }
		}
	}
}

function draw(){
	//draw water
	ctx.fillStyle = "#191970";
	ctx.fillRect(0,0,GAME_WIDTH,WATER_HEIGHT+HEADER_HEIGHT);
	//draw road
	ctx.fillStyle = "#000000";
	ctx.fillRect(0,ROAD_Y - 1,GAME_WIDTH,ROAD_HEIGHT + 1);
	//draw header
	ctx.drawImage(sprite, 0, 0, GAME_WIDTH, HEADER_HEIGHT, 0, 0, GAME_WIDTH, HEADER_HEIGHT);
	//draw roadsides
	ctx.drawImage(sprite, 0, SIDE_Y, GAME_WIDTH, SIDE_HEIGHT, 0, SIDE_H_Y, GAME_WIDTH, SIDE_HEIGHT);
	ctx.drawImage(sprite, 0, SIDE_Y, GAME_WIDTH, SIDE_HEIGHT, 0, SIDE_L_Y, GAME_WIDTH, SIDE_HEIGHT);
	//draw footer
	ctx.fillRect(0,FOOTER_Y - 1,GAME_WIDTH,GAME_HEIGHT - FOOTER_Y - 1);
	for(i = 0; i < lives; i++){
		ctx.drawImage(sprite, pos['frog']['x'], pos['frog']['y'], pos['frog']['width'], 
			pos['frog']['height'], i * pos['frog']['width']*2/3, FOOTER_Y,pos['frog']['width']*2/3, 
			pos['frog']['height']*2/3);
	}
	if(time > 10){ ctx.fillStyle = "#00FF00"; }
	else{ ctx.fillStyle = "#FF0000"; }
	ctx.fillRect(GAME_WIDTH - time*2, GAME_HEIGHT - GAME_SPACE/2, time*2, GAME_SPACE/2);
	ctx.fillStyle = "#00FF00";
	ctx.font = "bold 16pt sans-serif";
	ctx.fillText("Level "+level, 50, 545);
	ctx.font = "bold 10pt sans-serif"
	ctx.fillText("Score: "+score, 0, 560);
	ctx.fillText("Highscore: "+highscore, 80, 560);
	//draw filled slots
	ctx.fillStyle = "#08CF33"
	for(i = 0; i < 5; i++){
		if(pos['slots'][i]['done']){
			ctx.beginPath();
			ctx.arc(pos['slots'][i]['x'] + SLOT_WIDTH/2,WATER_Y - 16,11,0,Math.PI*2,true);
			ctx.closePath();
			ctx.fill();
		}
	}
	//draw cars
	for(i = 0; i < 5; i++){
		for(j = 0; j < cars[i].length; j++){
			ctx.drawImage(sprite, pos['cars'][i]['x'], pos['cars'][i]['y'], pos['cars'][i]['width'], 
				pos['cars'][i]['height'], cars[i][j], ROAD_Y + GAME_SPACE * i, pos['cars'][i]['width'], 
				pos['cars'][i]['height']);
		}
	}
	//draw logs
	for(i = 0; i < 5; i++){
		for(j = 0; j < logs[i].length; j++){
			ctx.drawImage(sprite, pos['logs'][i]['x'], pos['logs'][i]['y'], pos['logs'][i]['width'], 
				pos['logs'][i]['height'], logs[i][j], WATER_Y + GAME_SPACE * i, pos['logs'][i]['width'], 
				pos['logs'][i]['height']);
		}
	}
	if(!dead && !completed && !game_over){
		//draw frog
		ctx.drawImage(sprite, pos['frog']['x'] + 68 *(frog_dir%2) + 34*jump, 
			pos['frog']['y'] + 30*Math.floor(frog_dir/2), pos['frog']['width'], pos['frog']['height'], 
			frog_x, frog_y, pos['frog']['width'], pos['frog']['height']);
		if(jump){jump = false;}
	}
	if(dead){
		ctx.drawImage(dead_frog, frog_x, frog_y);
		if(game_over){
			ctx.fillStyle = "#000000";
			ctx.fillRect(60,250,280,140);
			ctx.fillStyle = "#FF0000";
			ctx.font = "bold 30pt sans-serif";
			ctx.fillText("GAME OVER", 80, 300);
			ctx.fillStyle = "#00FF00";
			ctx.font = "bold 20pt sans-serif";
			ctx.fillText("Score: "+score,80,330);
			ctx.fillText("Highscore: "+highscore,80,360);
		}
	}
	if(level_completed){
		ctx.fillStyle = "#00FF00";
		ctx.font = "bold 30pt sans-serif";
		if(game_completed){
			ctx.fillStyle = "#000000";
			ctx.fillRect(90,250,230,140);
			ctx.fillStyle = "#00FF00";
			ctx.font = "bold 30pt sans-serif";
			ctx.fillText("YOU WIN", 110, 300);
			ctx.font = "bold 20pt sans-serif";
			ctx.fillText("Score: "+score,110,330);
			ctx.fillText("Highscore: "+highscore,110,360);
		}
		else { 	ctx.fillText("LEVEL COMPLETE", 25, 300); }
	}	
}

function update(){
	//update time
	time -= 1/fps;
	
    //update cars
	for(i = 0; i < 5; i++){
		for(j = 0; j < cars[i].length; j++){
			if(cars[i][j] > (GAME_WIDTH + 50)){
				cars[i][j] = -50;
			}
			else if(cars[i][j] < -50){
				cars[i][j] = GAME_WIDTH + 50;
			}
			else{
				cars[i][j] += car_speeds[i]/fps;
			}
		}
	}
	
	//update logs
	for(i = 0; i < 5; i++){
		for(j = 0; j < logs[i].length; j++){
			if(logs[i][j] > (GAME_WIDTH + 50)){
				logs[i][j] = -pos['logs'][i]['width'];
			}
			else if(logs[i][j] < -pos['logs'][i]['width']){
				logs[i][j] = GAME_WIDTH + 50;
			}
			else{
				logs[i][j] += log_speeds[i]/fps;
			}
		}
	}
	
	if( frog_y >= SIDE_H_Y || frog_y < WATER_Y){ frog_speed = 0; }
	//update frog if it has a speed
	frog_x += frog_speed/fps;
}

function checkForEvents(){
	if(time < 0){ dead = true; }
	if(frog_x < 0){ dead = true; frog_x += GAME_SPACE; buzzer.play(); }
	if(frog_x > (GAME_WIDTH - GAME_SPACE)){ dead = true; frog_x -= GAME_SPACE; buzzer.play(); }
	if(frog_y > SIDE_L_Y){ dead = true; frog_y -= GAME_SPACE; buzzer.play(); }
	//check for car collision
	if(frog_y < SIDE_L_Y && frog_y > SIDE_H_Y){
	    var lane = Math.round((frog_y - ROAD_Y)/GAME_SPACE);
		for(i = 0; i < cars[lane].length; i++){
			if((frog_x + pos['frog']['width']) > cars[lane][i] && 
				frog_x < (cars[lane][i] + pos['cars'][lane]['width'])){ 
				if(!dead){ splat.play(); }
				dead = true; 
			}
		}
	}
	//check if frog is on a log
	else if(frog_y < SIDE_H_Y && frog_y >= WATER_Y){
	    var lane = Math.round((frog_y - WATER_Y)/GAME_SPACE);
	    var safe = false;
		for(i = 0; i < logs[lane].length; i++){
			if((frog_x + pos['frog']['width']/ 2) > logs[lane][i] && 
				(frog_x + pos['frog']['width']/2) < (logs[lane][i] + pos['logs'][lane]['width'])){ 
				safe = true; 
			}
		}
		if(safe) { frog_speed = log_speeds[lane]; }
		else { dead = true; frog_speed = 0; splash.play(); }
	}
	//check if frog made it to slot
	else if(frog_y < WATER_Y){
		for(i = 0; i < 5; i++){
			if(frog_x >= pos['slots'][i]['x'] && 
				(frog_x + pos['frog']['width']) <= (pos['slots'][i]['x'] + SLOT_WIDTH)){
				if(!pos['slots'][i]['done']){ score += level*(lives+1)*50; farthest = 0; }
				completed = true;
				pos['slots'][i]['done'] = true;
				var all_complete = true;
				for(j = 0; j < 5; j++){
					if(!pos['slots'][j]['done']){ all_complete = false; }
				}
				if(all_complete){ 
					level_completed = true; score += level*(lives+1)*200;
					if(level == 5){ game_completed = true; }
				}
			}
		}
		if(!completed){ dead = true; frog_y += GAME_SPACE;}
	}
	
}
