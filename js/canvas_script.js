(function() {
    var upload = document.getElementById('fileUpload');
    var canvas = this.__canvas = new fabric.Canvas('editor');
    var imgbuffer;
    var textArr = [];


    function setStyle(object, styleName, value) {
        if (object.setSelectionStyles && object.isEditing) {
            var style = { };
            style[styleName] = value;
            object.setSelectionStyles(style);
        }
        else {
            object[styleName] = value;
        }
    }
    function addHandler(id, fn, eventName) {
        document.getElementById(id)[eventName || 'onclick'] = function() {
            var el = this;
                var obj = canvas.getActiveObject()
                    fn.call(el, obj);
                    canvas.renderAll();

        };
    }

    addHandler('color', function(obj) {
        setStyle(obj, 'fill', this.value);
    }, 'onchange');
    addHandler('size', function(obj) {
        setStyle(obj, 'fontSize', parseInt(this.value, 10));
    }, 'onchange');
    fabric.Object.prototype.transparentCorners = false;
    upload.addEventListener('change', function (e) {
        var image = URL.createObjectURL(upload.files[0]);
        imgbuffer = image;

        clear();
    });

    document.getElementById('addtextBut').addEventListener('click', function () {
        // textArr.push(document.getElementById('addtext').value);

        var index = textArr.push(canvas.add(new fabric.IText(document.getElementById('addtext').value, {
            left: 100, //Take the block's position
            top: 100,
            fill: 'black'
        })));
        console.log(index);
        textArr[index-1].on('selected', function() {
            console.log('selected text');
        });
        // canvas.add(new fabric.Text(document.getElementById('addtext').value, {
        //     left: 100, //Take the block's position
        //     top: 100,
        //     fill: 'black'
        // }));
    });
    // canvas.add(new fabric.Circle({ radius: 30, fill: '#f55', top: 100, left: 100 }));

    function clear() {
        canvas.clear();
        fabric.Image.fromURL(imgbuffer, function(oImg) {
            canvas.add(oImg);
        });

    }

})();