const blockName = 'side-by-side';
const fs 	    = require( 'fs' );

const directoryFiles = [
	`./src/blocks/${blockName}/*.php`,
	`./src/blocks/${blockName}/*.scss`,
	`./src/blocks/${blockName}/*.js`
];

module.exports = {
	presets:[  fs.existsSync( themePreset ) ? require(themePreset) : '' ],
	content: directoryFiles
};
