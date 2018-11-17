setTimeout(function() {
    drawCanvas();
    },500);

function drawCanvas(match_data){
console.log(data);
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var home_team_goals = data.home_team_goals;
    var away_team_goals = data.away_team_goals;
    var home_team_name = data.home_team_name;
    var away_team_name = data.away_team_name;
    var multiply = 1;
    var font_size = 15;
    var font_width = 15;
    var crest_width = 150;
    var crest_y = 690;
    var home_team_name_width = home_team_name.length * 5;
    var away_team_name_width = away_team_name.length * font_width;

    var home_team_crest = {
        src: data.home_team_crest,
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


    function image_template(source) {
        var bkimg = new Image();
        bkimg.crossOrigin = 'anonymous';
        bkimg.onload = function() {
            context.drawImage(bkimg, 0, 0);
        };
        bkimg.src = source;
    }

    function extra(source) {
        var bkimg = new Image();
        bkimg.crossOrigin = 'anonymous';
        bkimg.onload = function() {
            context.drawImage(bkimg, 0, 420);
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

    function write(obj, i=1) {
        if ( i > 1 ) {
            obj.pos.y = obj.pos.y + (i * 50);
        }
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

      var block = {
        a: { x:0,    y:548 },
        b: { x:900,  y:436 },
        c: { x:900,  y:1000 },
        d: { x:0,    y:1000 },
        color: data.colors.block
      };

      var lineabove = {
        a: { x:0,    y:541 },
        b: { x:900,  y:429 },
        c: { x:900,  y:446 },
        d: { x:0,    y:558 },
        color: data.colors.lineabove
      };

      var miniribbon = {
        a: { x:0,   y:563 },
        b: { x:385, y:516 },
        c: { x:385, y:520 },
        d: { x:0,   y:567 },
        color: data.colors.ribbon
      };

      var bigribbon = {
        a: { x:500,   y:450 },
        b: { x:900,   y:395 },
        c: { x:900,   y:475 },
        d: { x:510,   y:530 },
        color: data.colors.ribbon
      };

      var ribbontext = {
        font: 'epl-font',
        font_size: '40',
        color: data.colors.ribbontext,
        transform: true,
        tdata: { a: 1, b: -0.13, c: 0.1, d: 1, e: 0, f: 0},
        text: 'FULL TIME',
        pos: {x: 630, y: 565}
      };

    var result = {
        font: 'epl-font',
        font_size: '100',
        color: data.colors.result,
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: home_team_goals+'-'+away_team_goals,
        pos: {x: 450, y: 730}
    };

    var social = {
        font: 'epl-font',
        font_size: '30',
        color: data.colors.social,
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: 'PETERS APP',
        pos: {x: 158, y: 40}
    };

    var home_team_name = {
        font: 'epl-font',
        font_size: '18',
        color: '#ffffff',
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: data.home_team_name.toUpperCase(),
        pos: {x: 250, y: 580}
    };

    var away_team_name = {
        font: 'epl-font',
        font_size: '18',
        color: '#ffffff',
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: data.away_team_name.toUpperCase(),
        pos: {x: (away_team_crest.x + ( (away_team_crest.width - away_team_name_width) / 2 )), y: 580}
    };

    var home_team_scorer = {
        font: 'epl-font',
        font_size: '18',
        color: '#ffffff',
        transform: false,
        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
        text: data.goals.home[0].scorer.toUpperCase(),
        pos: {x: 250, y: 580}
    };

    new Promise(function(fulfill, reject){
        draw(block);
        extra(data.ucl_image);
        draw(lineabove);
        draw(miniribbon);
        draw(bigribbon);
        write(ribbontext);
        if(data.goals.home.length > 0) {
            for(i=0;i<data.goals.home.length; i++) {
                current_scorer = home_team_scorer;
                current_scorer.text = data.goals.home[i].scorer.toUpperCase()
                write(current_scorer, i+1);
            }
        }
        fulfill(result);
    }).then(function(result){
        return new Promise(function(fulfill, reject){
            write(result);
            write(social);
            addImage(home_team_crest);
            addImage(away_team_crest);
            fulfill(result);
        });
    }).then(function(result){
        return new Promise(function(fulfill, reject){
            setBackground(data.background_image);
            fulfill(result);
        });
    }).then(function(result){
        console.log(lineabove);
    });

    /*new Promise(function(fulfill, reject){
        //image_template(data.image_template);
        fulfill(result);
    }).then(function(result){
        return new Promise(function(fulfill, reject){
            write(result);
            //write(social);
            addImage(home_team_crest);
            addImage(away_team_crest);
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
    });*/
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