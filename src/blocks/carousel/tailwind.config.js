const { tailwindPreset } = require( '../../../postcss.config' );
const blockName = 'carousel';

const directoryFiles = [
	`./src/blocks/${ blockName }/*.php`,
	`./src/blocks/${ blockName }/*.scss`,
	`./src/blocks/${ blockName }/*.js`,
];

module.exports = {
	presets: [ require( tailwindPreset ) ],
	content: directoryFiles,
};
