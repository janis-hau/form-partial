module.exports = function( grunt ) {
	var globalConfig = {
		// @formatter:off
		sass : {
			src  : 'assets/scss/',
			dest : 'assets/css/'
		},
		js  : {
			dest   : 'assets/js/',
			libs   : 'assets/js/libs/',
			vendor : 'assets/js/vendor/'
		},
		php : ''
		// @formatter:on
	};

	grunt.initConfig( {
		globalConfig : globalConfig,
		/******************************************************
		 * SASS
		 ******************************************************/
		sass : {
			dist : {
				options : {// Target options
					style : 'compressed',
					precision : 5,
					update : false
				},
				files : {
					"<%= globalConfig.sass.dest %>style.css" : "<%= globalConfig.sass.src %>main.scss",
					"<%= globalConfig.sass.dest %>theme.css" : "<%= globalConfig.sass.src %>theme.scss"
				}
			}
		},
		/******************************************************
		 * UGLIFY
		 ******************************************************/
		uglify : {
			options : {
				mangle    : false,
				beautify  : false,
				report    : "gzip",
				sourceMap : true
			},
			my_target : {
				files : {
					//@formatter:off
					'<%= globalConfig.js.dest %>/output.min.js' : [
					// ********** LIBS ********** //
					'<%= globalConfig.js.libs %>jQuery/dist/jquery.min.js',
					'<%= globalConfig.js.libs %>jQuery.validation/dist/jquery.validate.js',
					'<%= globalConfig.js.libs %>jQuery.validation/dist/additional-methods.js',
					// ********** VENDOR ********** //
					'<%= globalConfig.js.vendor %>jQuery.validation.init.js',
					 ]
					//@formatter:on
				}
			}
		},
		// /******************************************************
		// * autoprefixer
		// ******************************************************/
		postcss : {
			options : {
				map : true, // inline sourcemaps

				// or
				map : {
					inline : false, // save all sourcemaps as separate files...
					annotation : '<%= globalConfig.sass.dest %>' // ...to the specified directory
				},

				processors : [ require('pixrem')( ), // add fallbacks for rem units
				require('autoprefixer')( {
					browsers : 'last 2 versions'
				} ), // add vendor prefixes
				require('cssnano')( ) // minify the result
				]
			},
			dist : {
				src : '<%= globalConfig.sass.dest %>*.css'
			}
		},
		// /******************************************************
		// * SERVER AND WATCH TASKS
		// ******************************************************/
		watch : {
			sass : {
				files : [ '<%= globalConfig.sass.src %>/**/*.scss' ],
				tasks : [ 'sass', 'postcss' ]
			},
			js : {
				files : [ '<%= globalConfig.js.vendor %>/**/*.js' ],
				tasks : [ 'uglify' ]
			},
			php : {
				files : [ '<%= globalConfig.phtml %>*.php' ],
				tasks : false
			},
			html : {
				files : [ '<%= globalConfig.phtml %>*.html' ],
				tasks : false
			},
			json : {
				files : [ '<%= globalConfig.phtml %>inc/*.json' ],
				tasks : false
			},
			options : {
				livereload : true,
				spawn : true,
				interrupt : false
			}
		}
	} );

	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-contrib-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-uglify' );
	grunt.loadNpmTasks( 'grunt-postcss' );

	grunt.registerTask( 'default', [ 'watch' ] );
	grunt.registerTask( 'css'    , [ 'sass', 'postcss' ] );
	grunt.registerTask( 'all'    , [ 'sass', 'postcss', 'uglify', 'watch' ] );
};

