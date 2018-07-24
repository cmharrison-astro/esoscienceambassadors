class Planet {
  constructor(name, htmlElement, orbitRadius, orbitalPeriod) {
    this.name = name;
    this.htmlElement = htmlElement;
    this.orbitRadius = orbitRadius * 400; // this multiplication is a guess- without it the radius is tiny
    this.orbitalPeriod = orbitalPeriod / 1000; // this division is a guess - without it the planets are SUPERFAST
    this.a = 0; // in radian
    this.x = 0;
    this.y = 0;
    // Center is actualy center (100, 100) minus half the size of the orbiting object 15x15
    this.center = { x: (100 - 15), y: (100 - 15) };

    // if you know what a, x and y represent, please name them something more meaninglyful
    // the x and y associated with center ARE NOT the same as the x and y associated with Planet

    this.move = () => {
      this.a += this.orbitalPeriod;
      this.x = this.center.x + (this.orbitRadius * Math.sin(this.a));
      this.y = this.center.y + (this.orbitRadius * Math.cos(this.a));
      this.htmlElement.style.top = this.y + "px";
      this.htmlElement.style.left = this.x + "px";
    }

    this.moveTimer = planet => {
      setInterval( () => {
        planet.move();
      }, 50);
    }

    this.greeting = () => {
      console.log('Hi! I\'m ' + this.name + '.');
    };
  }
};

const planets = [
  {
    rockFromSun: "planet0", 
    name: row.name_a,
    mass: row.mass_a,
    orbital_period: row.orbital_period_a,
    semi_major_axis: row.semi_major_axis_a
  },
  {
    rockFromSun: "planet1", 
    name: row.name_b,
    mass: row.mass_b,
    orbital_period: row.orbital_period_b,
    semi_major_axis: row.semi_major_axis_b
  },
  {
    rockFromSun: "planet2", 
    name: row.name_c,
    mass: row.mass_c,
    orbital_period: row.orbital_period_c,
    semi_major_axis: row.semi_major_axis_c
  },
  {
    rockFromSun: "planet3", 
    name: row.name_d,
    mass: row.mass_d,
    orbital_period: row.orbital_period_d,
    semi_major_axis: row.semi_major_axis_d
  },
  {
    rockFromSun: "planet4", 
    name: row.name_e,
    mass: row.mass_e,
    orbital_period: row.orbital_period_e,
    semi_major_axis: row.semi_major_axis_e
  },
  {
    rockFromSun: "planet5", 
    name: row.name_f,
    mass: row.mass_f,
    orbital_period: row.orbital_period_f,
    semi_major_axis: row.semi_major_axis_f
  },
  {
    rockFromSun: "planet6", 
    name: row.name_g,
    mass: row.mass_g,
    orbital_period: row.orbital_period_g,
    semi_major_axis: row.semi_major_axis_g
  },
  {
    rockFromSun: "planet7", 
    name: row.name_h,
    mass: row.mass_h,
    orbital_period: row.orbital_period_h,
    semi_major_axis: row.semi_major_axis_h
  }
]

const planetsFiltered = planets.filter(planet => planet.name);

planetsFiltered.forEach((planet) => {
  const myPlanet = new Planet(
    planet.name,
    document.getElementById(planet.rockFromSun),
    parseFloat(planet.semi_major_axis),
    parseFloat(planet.orbital_period)
  );

  myPlanet.greeting();
  myPlanet.moveTimer(myPlanet);
});
