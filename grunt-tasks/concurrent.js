module.exports = {
	dist : [
		'jshint', 'concat', 'sass:dist', 'imagemin'
	],
	dev : [
		'jshint', 'concat', 'sass:dev', 'handlebars:dev'
	]
};