//basic functions
var canvas = this.__canvas = new fabric.Canvas('editor', {width: 1754 ,height:1240});
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

(function() {
    window.mobileAndTabletcheck = function() {
        var check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    };
    if (window.mobileAndTabletcheck()){
        var cornersize = 250;
    }else{
        var cornersize = 100;
    }
    var upload = document.getElementById('fileUpload');

    var imgbuffer;
    var textArr = [];


    if(getUrlVars()['foto'] != ''){
        imgbuffer = decodeURIComponent(getUrlVars()['foto']);
        clear();
    }
    document.getElementById('deleteButton').addEventListener('click', function () {
        canvas.getActiveObject().remove();
    });
    document.addEventListener('keyup', function (e) {
        if(e.key == 'Delete'){
            canvas.getActiveObject().remove();
        }else if (e.key == 'Enter'){
            canvas.deactivateAll();
        };
    });
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
            var obj = canvas.getActiveObject();
            fn.call(el, obj);
            canvas.renderAll();

        };
    }

//code
    var input = document.createElement('INPUT');
    var picker = new jscolor(input, {
        value: "000000",
    });

    input.addEventListener('change', function(e){
        var color = e.target.value;
        var obj = canvas.getActiveObject();
        setStyle(obj, 'fill', '#'+color);
        canvas.renderAll();
    });
    document.getElementById('colordiv').appendChild(input);

    // addHandler('size', function(obj) {
    //     setStyle(obj, 'fontSize', parseInt(this.value, 10));
    // }, 'onchange');
    fabric.Object.prototype.transparentCorners = false;
    upload.addEventListener('change', function (e) {
        var image = URL.createObjectURL(upload.files[0]);
        imgbuffer = image;
        clear();
    });


    addHandler('font-family', function(obj) {
        if (this.value == 'meme'){
            setStyle(obj, 'stroke', '#000000');
            setStyle(obj, 'fill', '#ffffff');
            setStyle(obj, 'strokeWidth', 10);
            setStyle(obj, 'fontFamily', 'impact');
        }else{
            setStyle(obj, 'stroke', '');
            setStyle(obj, 'fill', '#' + input.value);
            setStyle(obj, 'strokeWidth', '');
            setStyle(obj, 'fontFamily', this.value);
        }

    }, 'onchange');
    document.getElementById('addtextBut').addEventListener('click', function () {
        canvas.deactivateAll();
        if (document.getElementById('font-family').value == 'meme'){
            var stroke = '#000000';
            var fill = '#ffffff';
            var strokewidth = 10;
            var fontfamily = 'impact';
        }else{
            var stroke = '';
            var fill = '#' + input.value;
            var strokewidth = '';
            var fontfamily = document.getElementById('font-family').value;
        }
        var index = textArr.push(canvas.add(new fabric.IText(document.getElementById('addtext').value, {
            left: 100, //Take the block's position
            top: 100,
            fontSize: '400',
            fill: fill,
            cornerSize: cornersize,
            stroke: stroke,
            strokeWidth: strokewidth,
            fontFamily: fontfamily
        })));
    });
    document.getElementById('deselect').addEventListener('click', function () {
        console.log('deselect');
        canvas.deactivateAll();
    });
    function clear() {
        canvas.clear();
        fabric.Image.fromURL(imgbuffer, function(oImg) {
            oImg.set({cornerSize: cornersize});
            canvas.add(oImg);
        });

    }
    document.getElementById('wagen').addEventListener('click', function () {
        canvas.deactivateAll();
        document.getElementById('loading').style.display = 'table-cell';
        var imgBase64 = canvas.toDataURL('image/jpg');
        document.getElementById('ImageToUpload').value = imgBase64;
        var fd = new FormData(document.forms["uploadForm"]);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'views/private/upload_ontwerp.php', true);
        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                var percentComplete = Math.ceil((e.loaded / e.total) * 100);
                console.log(percentComplete + '% uploaded');
            }
        };
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200){
                alert('Toegevoegd aan de winkelwagen');
                // document.getElementById('response').innerHTML = this.responseText;
                window.location.href = window.location.href.replace('/ontwerpen', '/winkelwagen');
            }
        };
        xhr.onload = function() {

        };
        xhr.send(fd);

    });
})();