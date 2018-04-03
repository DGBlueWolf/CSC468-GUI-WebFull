var canvas = document.getElementById('potato-canvas'),
    ctx = canvas.getContext('2d'),
    head = new Image(),
    eyes = new Image(),
    nose = new Image(),
    mouth = new Image(),
    feet = new Image(),
    leftside = new Image(),
    rightside = new Image();

function render(x, y){
    return function(){
        Promise.all([
            createImageBitmap(this)
        ]).then(function(sprites) {
            ctx.drawImage(sprites[0], x, y)
        })
    }
}

head.onload      = render(210, 20);
eyes.onload      = render(210, 170);
nose.onload      = render(210, 245);
mouth.onload     = render(210, 345);
feet.onload      = render(210, 420);
leftside.onload  = render(20, 20);
rightside.onload = render(430, 20);

head.src = 'images/base_head.png';
eyes.src = 'images/base_eyes.png';
nose.src = 'images/base_nose.png';
mouth.src = 'images/base_mouth.png';
feet.src = 'images/base_foot.png';
leftside.src = 'images/base_left.png';
rightside.src = 'images/base_right.png';

document.getElementById('potato-element-add').style.backgroundColor = "black";
document.getElementById('potato-element-add').style.backgroundColor = "#ccc";
document.getElementById('potato-element-replace').style.backgroundColor = "black";
document.getElementById('potato-element-replace').style.backgroundColor = "#ccc";
document.getElementById('potato-element-remove').style.backgroundColor = "black";
document.getElementById('potato-element-remove').style.backgroundColor = "#ccc";
