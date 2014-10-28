var ctx;
var level = 1;
var current_block_count = 1;
var blocks = new Array;
var bullets = new Array;
var fall_interval;
var new_block_interval;
var player;
var bullet_sprites = new Image();
var music = document.createElement('audio');
var username;

function player(x,y,speed,width,height){
	this.x=x;
	this.y=y;
	this.velocity=0;
	this.direction=1;
	this.speed=speed;
	this.width=width;
	this.height=height;
	this.animation=0;
	this.moving=false;
	this.shooting=false;
	this.cooldown = 0;
	this.movePlayer= movePlayer;
	this.score=0;
	this.animatePlayer = animatePlayer;
	this.lives=5;
}

function animatePlayer(){
	if(player.animation>10){
		player.animation = 0;
	}
	player.animation++;
}

function movePlayer(){
	this.x += this.direction*5*this.velocity;
	if(!this.moving){
		if(this.velocity>0){
			this.velocity=Math.floor(this.velocity/2);
		}
	}
	if(this.x>(ctx.canvas.width-20)){
		this.x = ctx.canvas.width-20;
	}
	if(this.x<0){
		this.x = 0;
	}
}

function bullet(x,y,speed,size){
	this.x=x;
	this.y=y;
	this.speed=speed;
	this.size=size;
	this.moveBullet = moveBullet;
	this.drawBullet = drawBullet;
	this.hitBlock = hitBlock;
}

function drawBullet() {
 	ctx.drawImage(bullet_sprites,40,0,35,40,this.x-Math.floor(this.size/2),this.y,20,20);
}

function moveBullet(){
	this.y -= this.size/(10-this.speed);
}

function hitBlock(block){
	if(Math.abs(this.x-(block.x+Math.floor(block.size/2)))<block.size && Math.abs(this.y-block.y)<block.size){
		return true;
	}
	else{
		return false;
	}
}

function block(x,y,speed,size)
{
	this.x=x;
	this.y=y;
	this.size=size;
	this.speed=speed; // 1 - 9 slow - fast
	this.moveBlock = moveBlock;
}

function moveBlock(){
	this.y += this.size/(13-this.speed);
}

function checkCollisions(){
	for(var i=0;i<bullets.length;i++){
	if(bullets[i].y<=0){
		bullets.splice(i,1);
	}
		for(var j=0;j<current_block_count && j<blocks.length;j++){
			if(bullets[i]!=null && blocks[j]!=null && bullets[i].hitBlock(blocks[j])){
				blocks.splice(j,1);
				bullets.splice(i,1);
				player.score++;
				$("#score_count").text(player.score);
			}

		}
		
	}
}

function draw()
{
	ctx = document.getElementById('game_canvas').getContext('2d');
	ctx.save();
	// Draw the board
	ctx.canvas.width  = window.innerWidth-10;
  	ctx.canvas.height = window.innerHeight-120;
	
	// Draw player
	ctx.fillStyle = 'rgb('+0+','+0+','+ 255+')';
	player.y = ctx.canvas.height-20;
	ctx.fillRect(player.x, player.y, player.width, player.height);
	player.movePlayer();
  	checkCollisions();
  	
	for(var i=0;i<current_block_count && i<blocks.length;i++){
		green = Math.floor(255 * (1-(blocks[i].y/ctx.canvas.height)));
		red = Math.floor(255 * blocks[i].y/ctx.canvas.height);
		ctx.fillStyle = 'rgb('+red+','+green+', 0)';
		ctx.fillRect(blocks[i].x, blocks[i].y, blocks[i].size, blocks[i].size);
	}
	
	for(var j=0;j<bullets.length;j++){
		bullets[j].drawBullet();
		bullets[j].moveBullet();
	}
	
	
	for(var i=0;i<current_block_count && i<blocks.length;i++){
		if(blocks[i].y>=(ctx.canvas.height-blocks[i].size)){
			
			// Player lost a life
			$('#life'+player.lives).hide();
			player.lives--;
			blocks.splice(i,1);

			
			
			if(player.lives<=0){
				clearInterval(fall_interval);
				if( (!localStorage.getItem("score") || (player.score>parseInt(localStorage.getItem("score")))) && player.score>0 ){
					var $gameover = $('<div>').attr('id','retry');
					$gameover.append($('<p>').attr('id','score_text').append("Enter your username to save your score."));
			
					// Set attributes
			
					$gameover.append($('<input>').attr({
						type: 'text',
						name: 'entry',
						id: 'entry_box',
						size: '20'
					}));
					
					$gameover.append($('<input>').attr({
						type: 'button',
						id: 'entry_button',
						value: 'Submit',
						onClick: 'submit_score()'
					}));
					
					$.fancybox({
						'overlayShow'	: false,
						'transitionIn'	: 'elastic',
						'transitionOut'	: 'elastic',
						'overlayColor'		: '#000',
						'overlayOpacity'	: 0.8,
            			'content' : $gameover
 					});
				}
				else{
					$("#retry").show();			
				}
			}
		}
		else{
			blocks[i].moveBlock();
		}
	}
	
	if(blocks.length==0){
		level++;
		$("#level_count").text(level);
		current_block_count = 1;
		generateBlockLocations();
	}
	
	if(player.moving && player.velocity<10){
		player.velocity+=1;
	}
	
	if(player.shooting && player.cooldown--==0){
		bullets.push(new bullet(player.x+Math.floor(player.width/2),player.y-10,8,5));
		player.cooldown = 2;
	}


	ctx.restore();
	
}

function generateBlockLocations(){
	
	for(var i=0;i<100*level;i++){
		random_block_x = Math.floor(Math.random()*(window.innerWidth-20))+1;
		random_block_speed = Math.floor(Math.random()*7+level);
		random_block_size = Math.floor(Math.random()*20)+10;
		blocks.push(new block(random_block_x,0,random_block_speed,random_block_size));
	}
	
}

function drawAnotherBlock(){
	current_block_count++;
}

function keyPress(e) {	
	if(e.keyCode == 40){
	}
	else if(e.keyCode == 38){
	}
	else if(e.keyCode == 37){
		if(player.direction == 1){
			player.direction = -1;
			player.velocity = 0;
		}
			player.moving = true;
	}
	else if(e.keyCode == 39){
			if(player.direction == -1){
				player.direction = 1;
				player.velocity = 0;
			}
			player.moving = true;
	}
	else if(e.keyCode == 32){
		// spacebar
		player.shooting = true;
	}
}

function keyUp(e){
	if(e.keyCode == 39 || e.keyCode == 37){
		player.moving = false;
	}
	else if(e.keyCode == 32){
		player.shooting = false;
	}
}

function submit_score(){
	username = $("#entry_box").val()
	$.post("http://secret-about-box.herokuapp.com/submit.json", {username: username, score: player.score, grid: "{}"}, function (data, textStatus) {
		try {
			localStorage[new Date()]= player.score + "|" + data;
		}
		catch (e) {
		}
		finally {
			load_high_scores();			
		}
	});
}

function load_high_scores() {
	$.getJSON("http://secret-about-box.herokuapp.com/scores.json?username=" + username, function(json) {
		scores = json;
		var $wrap = $('<div>').attr('id', 'scoresDiv');
		$wrap.append($('<h1>').text("High Scores"));
		var $tbl = $('<table>').attr('id', 'scoresTable');
		$tbl.append(
			$('<tr>').append($('<th>').text("Ranking"),$('<th>').text("User"),$('<th>').text("Score"))
		)
		for (var i = 0; i < scores.length; i++) {
			$tbl.append(
				$('<tr>')
					.append($('<td class="position">').text(i+1),
						$('<td>').html(scores[i].username),
						$('<td>').html(scores[i].score)
				));
		}
		$wrap.append($tbl);
		var $retry = $('<div>').attr('id','retry');
		$retry.append($('<p>').text("Retry?"));
			
		$retry.append($('<input>').attr({
			type: 'button',
			id: 'entrybutton',
			value: 'Yes',
			onClick: 'retry()'
		}));
			
		$wrap.append($retry);
			

		$.fancybox({
			'overlayShow'	: false,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'overlayColor'		: '#000',
			'overlayOpacity'	: 0.8,
           	'content' : $wrap
 		});
	});
}

function retry(){
	window.location.reload();
}


function init() {
	$.fancybox({
		'overlayShow'	: false,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'overlayColor'		: '#000',
		'overlayOpacity'	: 0.8,
        'content' : '<h1>Overview</h1><p>Kill as many falling blocks as possible.</p><h1>Controls</h1><ul><li>Spacebar - Shoot (hold down for rapid fire)</li><li>Left and Right Arrow Keys - Move left and right</li></ul><h1>Instructions</h1><ul><li>You start with 5 lives.</li><li>Move back and forth rapidly and shoot as fast as possible.</li><li>Each level contains 100 x level blocks.</li></ul><h1>Winning the Game</h1><p>You cannot win, you will eventually lose!  You win by shooting down the most blocks.</p><h1>Losing a Life</h1><p>You lose a life by letting a block hit the ground.  Game is over when you have no lives remaining.</p>',
        'onClosed' : runme
 	});
}

function runme()
{
	document.addEventListener('keydown', keyPress, false);
	document.addEventListener('keyup', keyUp,false);
	music.setAttribute('src', 'music.mp3');
	music.load();
	music.play();
	generateBlockLocations();
	player = new player(Math.floor(((window.innerWidth-10)/2)), ((window.innerHeight-20)-20),9,60,30);
	fps = 30;
	fall_interval = setInterval(draw,1000/fps);
	new_block_interval = setInterval(drawAnotherBlock,600/level);
	setInterval(animatePlayer,200);
	$("#score_count").text(player.score);
	$("#level_count").text(level);
	if(!localStorage.getItem("name")){
		$(".hscore_name").hide();
		$(".hscore").hide();
	}
	else{
		$(".hscore_name").show();
		$(".hscore").show();
		$("#high_score_name").text(localStorage.getItem("name"));
		$("#high_score").text(localStorage.getItem("score"));
	}
	
	bullet_sprites.onload = function(){
	
	}
	bullet_sprites.src = 'bullets.png';
}