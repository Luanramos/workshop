module.exports =  {
	styles : {
		files : ['<%= paths.style %>/**/*.scss', 'ghost/**/*.scss'],
		tasks : ['sass:dev']
	},
	templates : {
		files: ['handlebars/**/*.hbs'],
		tasks: ['handlebars:dist']
	},
	scripts : {
		files : '<%= concat.dist.src %>',
		tasks : ['jshint', 'concat:dist']
	},
	ghostTemplates : {
		files: ['ghost/handlebars/**/*.hbs'],
		tasks: ['handlebars:dev']
	},
	ghostScripts : {
		files : '<%= concat.dev.src %>',
		tasks : ['concat:dev']
	}
};