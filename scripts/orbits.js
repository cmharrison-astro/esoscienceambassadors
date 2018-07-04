
console.log('script is here!');

// init part, set your own values
var sat = {
    elt: null,
    a: 0,         // in radian
    r: 100,       // radius
    da: 0.05,     // in radian
    x: 0,
    y: 0,
    // Center is actualy center (100, 100) minus
    // half the size of the orbiting object 15x15
    center: { x: (100 - 15), y: (100 - 15) }
};

sat.move = function() {
    // each modification
    this.a += this.da
    this.x = this.center.x + (this.r * Math.sin(this.a));
    this.y = this.center.y + (this.r * Math.cos(this.a));
    //console.log(this.x, this.y);
    this.elt.style.top = this.y + "px";
    this.elt.style.left = this.x + "px";
};

sat.elt = document.getElementById('sat1');

var loopTimer = setInterval(function(){
    sat.move();
}, 50);
