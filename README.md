# ESO Science Ambassadors

## Getting started

You will need to setup a myphpadmin database from `exoplanet_table.csv`. Contact the repo admin for user details.

Setup MAMP if you don't have it already
Clone the project into /Applications/MAMP/htdocs
Run MAMP servers
Navigate to http://localhost:8888/esoscienceambassadors/index.php

This project uses JavaScript ES6 syntaxt, and therefore uses `babel` as a transpiler. In your terminal:
- `npm install`
- `npm run babel` - runs babel to create dist folder
When Javscript files are edited, re-run the `npm run babel` command above to re-build your `dist` folder.
