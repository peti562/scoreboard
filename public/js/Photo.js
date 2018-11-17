var Photo = function(){
    return{
        init:function(){
            sdf = 'fdg';
        },

        extra:function(source, context) {
            var bkimg = new Image();
            bkimg.crossOrigin = 'anonymous';
            bkimg.onload = function () {
                context.drawImage(bkimg, 0, 420);
            };
            bkimg.src = source;
        },

        addImage: function(obj, context){
            var img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = function() {
                var aspect_ratio = img.width / img.height;
                var newHeight = obj.width/aspect_ratio;
                var newY = obj.y - (newHeight/2);
                context.drawImage(img, obj.x, newY, obj.width, newHeight);
            };
            img.src = obj.src;
        },

        draw: function(obj, context) {
            context.beginPath();
            context.moveTo((obj.a.x*multiply), obj.a.y*multiply);
            context.lineTo((obj.b.x*multiply), obj.b.y*multiply);
            context.lineTo(obj.c.x*multiply, obj.c.y*multiply);
            context.lineTo(obj.d.x*multiply, obj.d.y*multiply);
            context.fillStyle = obj.color;
            context.fill();
        },

        setBackground: function(source, context){
            var bkimg = new Image();
            bkimg.crossOrigin = 'anonymous';
            bkimg.onload = function() {
                var aspect_ratio = bkimg.width / bkimg.height;
                var newHeight = canvas.width/aspect_ratio;
                context.globalCompositeOperation='destination-over';
                context.drawImage(bkimg, 0, 0, canvas.width, newHeight);
            };
            bkimg.src = source;
        },

        write: function(obj, context, i=1) {
            if ( i > 1 ) {
                obj.pos.y = obj.pos.y + 50;
            }
            if(obj) {
                context.font = (obj.font_size+'pt '+obj.font);
                context.textAlign = 'center';
                context.fillStyle = obj.color;
                context.transform(obj.tdata.a, obj.tdata.b, obj.tdata.c, obj.tdata.d, obj.tdata.e, obj.tdata.f);
                context.fillText(obj.text, obj.pos.x, obj.pos.y);
                context.transform(obj.tdata.a, (obj.tdata.b*-1), (obj.tdata.c*-1), obj.tdata.d, obj.tdata.e, obj.tdata.f);
            }
        },
        goalScorers: function(context){
            if(data.goals.home) {
                for(i=0;i<data.goals.home.length; i++) {
                    current_scorer = {
                        font: font_type,
                        font_size: '18',
                        color: data.colors.home.color4,
                        transform: false,
                        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
                        text: data.goals.home[i].scorer.toUpperCase(),
                        pos: {x: 250, y: 850}
                    };
                    this.write(current_scorer, context, i+1);
                }
            }
            if(data.goals.away) {
                for(i=0;i<data.goals.away.length; i++) {
                    current_scorer = {
                        font: font_type,
                        font_size: '18',
                        color: data.colors.home.color4,
                        transform: false,
                        tdata: { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0},
                        text: data.goals.away[i].scorer.toUpperCase(),
                        pos: {x: 660, y: 850}
                    };
                    this.write(current_scorer, context, i+1);
                }
            }
        }
    }
}();