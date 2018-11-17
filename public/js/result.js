var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var home_team_goals = data.match_hometeam_score;
var away_team_goals = data.match_awayteam_score;
var home_team_name = data.match_hometeam_name;
var away_team_name = data.match_awayteam_name;
var multiply = 1;
var font_size = 15;
var font_type = 'epl-font';
var font_width = 15;
var crest_width = 150;
var crest_y = 690;
var home_team_name_width = home_team_name.length * 5;
var away_team_name_width = away_team_name.length * font_width;

var home_team_crest = {
    src: data.home_team_crest,
    x: 170,
    x: 170,
    y: crest_y,
    width: crest_width
};

var away_team_crest = {
    src: data.away_team_crest,
    x: canvas.width-home_team_crest.x-crest_width,
    y: crest_y,
    width: crest_width
};

var block = {
    a: { x:0,    y:548 },
    b: { x:900,  y:436 },
    c: { x:900,  y:1000 },
    d: { x:0,    y:1000 },
    color: data.colors.home.color1
};

var lineabove = {
    a: { x:0,    y:541 },
    b: { x:900,  y:429 },
    c: { x:900,  y:446 },
    d: { x:0,    y:558 },
    color: data.colors.home.color4
};

var miniribbon = {
    a: { x:0,   y:563 },
    b: { x:385, y:516 },
    c: { x:385, y:520 },
    d: { x:0,   y:567 },
    color: data.colors.home.color2
};

var bigribbon = {
    a: { x:500,   y:450 },
    b: { x:900,   y:395 },
    c: { x:900,   y:475 },
    d: { x:510,   y:530 },
    color: data.colors.home.color2
};

var ribbontext = {
    font: font_type,
    font_size: '40',
    color: data.colors.home.color3,
    transform: true,
    tdata: { a: 1, b: -0.13, c: 0.1, d: 1, e: 0, f: 0},
    text: 'FULL TIME',
    pos: {x: 630, y: 565}
};

var result = {
    font: font_type,
    font_size: '100',
    color: data.colors.home.color4,
    transform: false,
    tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
    text: home_team_goals+'-'+away_team_goals,
    pos: {x: 450, y: 730}
};

var social = {
    font: font_type,
    font_size: '30',
    color: data.colors.home.color4,
    transform: false,
    tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
    text: 'PETERS APP',
    pos: {x: 158, y: 40}
};

var home_team_name = {
    font: font_type,
    font_size: '18',
    color: '#ffffff',
    transform: false,
    tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
    text: home_team_name.toUpperCase(),
    pos: {x: 250, y: 580}
};

setTimeout(function() {
    Photo.init();
    drawCanvas();
    },500);


function drawCanvas(match_data){
    new Promise(function(fulfill, reject){
        Photo.draw(block, context);
        Photo.extra(data.ucl_image, context);
        Photo.draw(lineabove, context);
        Photo.draw(miniribbon, context);
        Photo.draw(bigribbon, context);
        Photo.write(ribbontext, context);
        if(data.goals){
            Photo.goalScorers(context);
        }
        fulfill(result);
    }).then(function(result){
        return new Promise(function(fulfill, reject){
            Photo.write(result, context);
            Photo.write(social, context);
            Photo.addImage(home_team_crest, context);
            Photo.addImage(away_team_crest, context);
            fulfill(result);
        });
    }).then(function(result){
        return new Promise(function(fulfill, reject){
            Photo.setBackground(data.background_image, context);
            fulfill(result);
        });
    }).then(function(result){
        console.log(lineabove);
    });
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