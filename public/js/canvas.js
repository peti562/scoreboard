setTimeout(function() {
    drawCanvas();
    },500);

function drawCanvas(match_data){

    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var home_goals = data.home_goals;
    var away_goals = data.away_goals;
    var home_team_name = data.home_team_name;
    var away_team_name = data.away_team_name;
    var multiply = 1;
    var font_size = 15;
    var font_width = 15;
    var crest_width = 150;
    var crest_y = 660;
    var home_team_name_width = home_team_name.length * 5;
    var away_team_name_width = away_team_name.length * font_width;

    var home_crest = {
        src: data.home_crest,
        x: 100,
        y: crest_y,
        width: crest_width
    };

    var away_crest = {
        src: data.away_crest,
        x: canvas.width-home_crest.x-crest_width,
        y: crest_y,
        width: crest_width
    };


    function image_template(source) {
        var bkimg = new Image();
        bkimg.crossOrigin = 'anonymous';
        bkimg.onload = function() {
            context.drawImage(bkimg, 0, 0);
        };
        bkimg.src = source;
    }

    function draw(obj){
        context.beginPath();
        context.moveTo((obj.a.x*multiply), obj.a.y*multiply);
        context.lineTo((obj.b.x*multiply), obj.b.y*multiply);
        context.lineTo(obj.c.x*multiply, obj.c.y*multiply);
        context.lineTo(obj.d.x*multiply, obj.d.y*multiply);
        context.fillStyle = obj.color;
        context.fill();
    }

    function write(obj) {
        context.font = (obj.font_size+'pt '+obj.font);
        context.textAlign = 'center';
        context.fillStyle = obj.color;
        context.transform(obj.tdata.a, obj.tdata.b, obj.tdata.c, obj.tdata.d, obj.tdata.e, obj.tdata.f);
        context.fillText(obj.text, obj.pos.x, obj.pos.y);
        context.transform(obj.tdata.a, (obj.tdata.b*-1), (obj.tdata.c*-1), obj.tdata.d, obj.tdata.e, obj.tdata.f);
    };

    function addImage(obj) {
        var img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = function() {
            var aspect_ratio = img.width / img.height;
            var newHeight = obj.width/aspect_ratio;
            var newY = obj.y - (newHeight/2);
            context.drawImage(img, obj.x, newY, obj.width, newHeight);
        };
        img.src = obj.src;
    };

    function setBackground(source) {
        var bkimg = new Image();
        bkimg.crossOrigin = 'anonymous';
        bkimg.onload = function() {
            var aspect_ratio = bkimg.width / bkimg.height;
            var newHeight = canvas.width/aspect_ratio;
            context.globalCompositeOperation='destination-over';
            context.drawImage(bkimg, 0, 0, canvas.width, newHeight);
        };
        bkimg.src = source;
    }

    var result = {
        font: 'wc-font',
        font_size: '70',
        color: '#ffffff',
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: home_goals+'-'+away_goals,
        pos: {x: 345, y: 685}
    };

    var social = {
        font: 'epl-font',
        font_size: '30',
        color: '#ffffff',
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: 'HUNFIELD ROAD',
        pos: {x: 153, y: 685}
    };

    var home_team_name = {

        font: 'wc-font',
        font_size: '15',
        color: '#ffffff',
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: 'RUSSIA',
        pos: {x: 250, y: 580}
    };

    var away_team_name = {
        font: 'wc-font',
        font_size: '15',
        color: '#ffffff',
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: 'RUSSIA',
        pos: {x: (away_crest.x + ( (away_crest.width - away_team_name_width) / 2 )), y: 580}
    };

    new Promise(function(fulfill, reject){
        //image_template(data.image_template);
        fulfill(result);
    }).then(function(result){
        return new Promise(function(fulfill, reject){
            write(result);
            //write(social);
            addImage(home_crest);
            addImage(away_crest);
            fulfill(result);
        });
    }).then(function(result){
        return new Promise(function(fulfill, reject){
            setTimeout(function () {
                setBackground(data.image_template);
                setBackground(data.background_image);
            }, 200);
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