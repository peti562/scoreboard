var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var home_team_goals = data.match_hometeam_score;
var away_team_goals = data.match_awayteam_score;
var home_team_name = data.match_hometeam_name;
var away_team_name = data.match_awayteam_name;
var multiply = 1;
var font_size = 15;
var font_type = data.font_type;
var font_width = 15;
var crest_width = 150;
var crest_y = 130;
var home_team_name_width = home_team_name.length * 5;
var away_team_name_width = away_team_name.length * font_width;

var home_team_crest = {
    src: data.home_team_crest,
    x: 150,
    y: crest_y,
    width: crest_width
};

var away_team_crest = {
    src: data.away_team_crest,
    x: canvas.width-home_team_crest.x-crest_width,
    y: crest_y,
    width: crest_width
};

var block_home = {
    a: { x:0,    y:0 },
    b: { x:470,  y:0 },
    c: { x:430,  y:1000 },
    d: { x:0,    y:1000 },
    color: data.colors.home.color1
};

var block_away = {
    a: { x:470,  y:0 },
    b: { x:900,  y:0 },
    c: { x:900,  y:1000 },
    d: { x:430,    y:1000 },
    color: data.colors.away.color1
};

var home_team_name = {
    font: font_type,
    font_size: '25',
    color: data.colors.home.color4,
    transform: false,
    tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
    text: home_team_name.toUpperCase(),
    pos: {x: 235, y: 280}
};

var away_team_name = {
    font: font_type,
    font_size: '25',
    color: data.colors.away.color4,
    transform: false,
    tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
    text: away_team_name.toUpperCase(),
    pos: {x: 685, y: 280}
};

function writeLineUp(team, context){
    player = {
        font: font_type,
        font_size: '22',
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: 'XXXXXXXXX',
        pos: {x: 220, y: 380}
    };
    if(team == 'away') {
        player.pos.x = 670;
    }
    player.color = data.colors[team]['color4'];
    //debugger;
    for(i=0;i<data.lineup.home.starting_lineups.length; i++) {
        number  = data.lineup[team]['starting_lineups'][i]['lineup_number'];
        name    = data.lineup[team]['starting_lineups'][i]['lineup_player'].toUpperCase();
        player.text = number + ' ' + name;
        Photo.write(player, context, i+1);
    }
}


setTimeout(function() {
    Photo.init();
    drawCanvas();
},500);


function drawCanvas(match_data){
    new Promise(function(fulfill, reject){
        Photo.draw(block_home, context);
        Photo.draw(block_away, context);
        Photo.write(home_team_name, context);
        Photo.write(away_team_name, context);
        writeLineUp('home', context);
        writeLineUp('away', context);
        Photo.addImage(home_team_crest, context);
        Photo.addImage(away_team_crest, context);
        fulfill(result);
    })
};

function savingTheCanvas(){
    // Generate the image data
    var pic = document.getElementById("canvas").toDataURL("image/png");
    pic = pic.replace(/^data:image\/(png|jpg);base64,/, "");
    console.log(pic);
    // Sending the image data to Server
    /* $.ajax({
         type: 'POST',
         url: 'hunfieldroad/UploadPic',
         data: '{ "imageData" : "' + pic + '" }',
         contentType: 'application/json; charset=utf-8',
         dataType: 'json',
         success: function (msg) {
             alert("Done, Picture Uploaded.");
         }
     });*/
}