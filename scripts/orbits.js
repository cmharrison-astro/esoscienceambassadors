class Planet {
    constructor(name, htmlElement, a, orbitRadius, da) {
        this.name = name;
        this.htmlElement = htmlElement,
        this.a = a, // in radian
        this.orbitRadius = orbitRadius,
        this.da = da, // in radian
        this.x = 0,
        this.y = 0;
        // Center is actualy center (100, 100) minus
        // half the size of the orbiting object 15x15
        this.center = { x: (100 - 15), y: (100 - 15) }

        // if you know what a, da, x and y represent, please name them something more meaninglyful
        // I figured out elt and r
        // the x and y associated with center ARE NOT the same as the x and y associated with Planet

        this.move = () => {
            this.a += this.da
            this.x = this.center.x + (this.orbitRadius * Math.sin(this.a));
            this.y = this.center.y + (this.orbitRadius * Math.cos(this.a));
            this.htmlElement.style.top = this.y + "px";
            this.htmlElement.style.left = this.x + "px";
        }

        // this is just for demo purpose - it should output in your browser console
        this.greeting = () => {
            console.log('Hi! I\'m ' + this.name + '.');
        };
    }
};

// instantiate your object
// this is where database values will plug in
const planet1 = new Planet('planet1', document.getElementById('planet1'), 0, 57, 0.02);
const planet2 = new Planet('planet2', document.getElementById('planet2'), 0, 150, 0.08);

// this is just for demo purpose - it should output in your browser console
planet1.greeting();
planet2.greeting();

// this function can probably get moved into the class
const loopTimer = setInterval(function(){
    planet1.move();
}, 1000); // the function is called every 50 milliseconds

const loopTimer2 = setInterval(function(){
    planet2.move();
}, 1000);

const foo = document.getElementById("dom-target");
const bar = foo.textContent;
const baz = bar.trim();

console.log('#######', foo);


console.log(`*${baz}*`);






