var curstep = 0;
var steps = ['step-1', 'step-2', 'step-3', 'step-4'];
var prev = document.getElementById('prev');
var next = document.getElementById('next');

next.addEventListener('click', function () {
    if (curstep+2> steps.length){
        next.style.display = 'none';
    }else{
        curstep++;
        changeStep(curstep);
        prev.style.display = 'inline';
        if (curstep+2> steps.length){
                document.getElementById('ImageToUpload').value = canvas.toDataURL('image/jpg');
                console.log(document.getElementById('ImageToUpload').value);
            next.style.display = 'none';
        }
    }

});
prev.addEventListener('click', function () {
    if (curstep-1<0){
        prev.style.display = 'none';
    }else{
        curstep--;
        next.style.display = 'inline';
        changeStep(curstep);

        if (curstep-1<0){
            prev.style.display = 'none';
        }
    }

});
function changeStep(stepNumber) {
    steps.forEach(function (id) {
       document.getElementById(id).style.display = 'none';
    });
    document.getElementById(steps[stepNumber]).style.display = 'block';
}
changeStep(0);

//stap 1
