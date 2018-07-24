class Planet {
  constructor(name, htmlElement, orbitRadius, orbitalPeriod) {
    this.name = name;
    this.htmlElement = htmlElement;
    this.orbitRadius = orbitRadius;
    this.orbitalPeriod = orbitalPeriod;
    this.a = 0; // in radian
    this.x = 0;
    this.y = 0;
    // Center is actually center minus half the size of the orbiting object
    this.center = { x: (125 - 12.5), y: (125 - 12.5) };

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
    semi_major_axis: planetRValues[0],
    orbital_period: planetDaValues[0]
  },
  {
    rockFromSun: "planet1", 
    name: row.name_b,
    mass: row.mass_b,
    semi_major_axis: planetRValues[1],
    orbital_period: planetDaValues[1]
  },
  {
    rockFromSun: "planet2", 
    name: row.name_c,
    mass: row.mass_c,
    semi_major_axis: planetRValues[2],
    orbital_period: planetDaValues[2]
  },
  {
    rockFromSun: "planet3", 
    name: row.name_d,
    mass: row.mass_d,
    semi_major_axis: planetRValues[3],
    orbital_period: planetDaValues[3]
  },
  {
    rockFromSun: "planet4", 
    name: row.name_e,
    mass: row.mass_e,
    semi_major_axis: planetRValues[4],
    orbital_period: planetDaValues[4]
  },
  {
    rockFromSun: "planet5", 
    name: row.name_f,
    mass: row.mass_f,
    semi_major_axis: planetRValues[5],
    orbital_period: planetDaValues[5]
  },
  {
    rockFromSun: "planet6", 
    name: row.name_g,
    mass: row.mass_g,
    semi_major_axis: planetRValues[6],
    orbital_period: planetDaValues[6]
  },
  {
    rockFromSun: "planet7", 
    name: row.name_h,
    mass: row.mass_h,
    semi_major_axis: planetRValues[7],
    orbital_period: planetDaValues[7]
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

  myPlanet.moveTimer(myPlanet);
});
