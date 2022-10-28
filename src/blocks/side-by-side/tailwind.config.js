const { tailwindPreset } = require( '../../../postcss.config' );
const blockName = 'side-by-side';

const directoryFiles = [
	`./src/blocks/${ blockName }/*.php`,
	`./src/blocks/${ blockName }/*.scss`,
	`./src/blocks/${ blockName }/*.js`,
];

module.exports = {
	presets: [ require( tailwindPreset ) ],
	content: directoryFiles,
};
