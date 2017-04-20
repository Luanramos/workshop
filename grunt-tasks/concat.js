module.exports = {
	options : {
		separator : ';'
	},
	dist : {
		src : [
			'<%= paths.js %>/libs/*.js',
			'<%= paths.js %>/templates/*.js',
			'<%= paths.js %>/vendor/*.js',
			'<%= paths.js %>/app/*.js',
			'<%= paths.js %>/boot.js'
		],
		dest : '<%= paths.js %>/built.js',
	},
	dev : {
		src : [
			'<%= paths.ghostJs %>/libs/*.js',
			'<%= paths.js %>/libs/*.js',
			'<%= paths.ghostJs %>/templates/*.js',
			'<%= paths.js %>/vendor/*.js',
			'<%= paths.js %>/app/*.js',
			'!<%= paths.js %>/app/application.js',
			'<%= paths.ghostJs %>/app/*.js',
			'<%= paths.ghostJs %>/boot.js'
		],
		dest : '<%= paths.ghostJs %>/built.js',
	}
};