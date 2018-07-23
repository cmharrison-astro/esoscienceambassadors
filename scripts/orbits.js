class Planet {
  constructor(name, htmlElement, a, orbitRadius, orbitalPeriod) {
    this.name = name;
    this.htmlElement = htmlElement,
    this.a = a, // in radian
    this.orbitRadius = orbitRadius * 400, // this multiplication is a guess- without it the radius is tiny
    this.orbitalPeriod = orbitalPeriod / 1000, // this division is a guess - without it the planets are SUPERFAST
    this.x = 0,
    this.y = 0;
    // Center is actualy center (100, 100) minus half the size of the orbiting object 15x15
    this.center = { x: (100 - 15), y: (100 - 15) }

    // if you know what a, x and y represent, please name them something more meaninglyful
    // the x and y associated with center ARE NOT the same as the x and y associated with Planet

    this.move = () => {
      this.a += this.orbitalPeriod;
      this.x = this.center.x + (this.orbitRadius * Math.sin(this.a));
      this.y = this.center.y + (this.orbitRadius * Math.cos(this.a));
      this.htmlElement.style.top = this.y + "px";
      this.htmlElement.style.left = this.x + "px";
    }

    this.moveTimer = (planet) => {
      setInterval( () => {
        planet.move();
      }, 50);
    }

    // this is just for demo purpose - it should output in your browser console
    this.greeting = () => {
      console.log('Hi! I\'m ' + this.name + '.');
    };
  }
};

// instantiate your object
const planet0 = new Planet(
  row.name_a,
  document.getElementById('planet0'),
  0, // who knows what this is?
  parseFloat(row.semi_major_axis_a),
  parseFloat(row.orbital_period_a)
);

const planet1 = new Planet(
  row.name_b,
  document.getElementById('planet1'),
  0,
  parseFloat(row.semi_major_axis_b),
  parseFloat(row.orbital_period_b)
);

const planet2 = new Planet(
  row.name_c,
  document.getElementById('planet2'),
  0,
  parseFloat(row.semi_major_axis_c),
  parseFloat(row.orbital_period_c)
);

const planet3 = new Planet(
  row.name_c,
  document.getElementById('planet2'),
  0,
  parseFloat(row.semi_major_axis_c),
  parseFloat(row.orbital_period_c)
);

console.log('#####', nPlanet);



planet0.greeting();
planet1.greeting();
planet2.greeting();
planet3.greeting();

planet0.moveTimer(planet0);
planet1.moveTimer(planet1);
planet2.moveTimer(planet2);
planet3.moveTimer(planet3);
