module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      build: {
        src: 'src/<%= pkg.name %>.js',
        dest: 'build/<%= pkg.name %>.min.js'
      }
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  // Default task(s).
  grunt.registerTask('default', ['uglify']);

  grunt.loadNpmTasks('grunt-php');
  // Load the plugin that provides the "watch" task.
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Run predefined tasks whenever watched file patterns are added, changed or deleted
  
  require('load-grunt-tasks')(grunt); // npm install --save-dev load-grunt-tasks

  // https://github.com/sindresorhus/grunt-php
  // https://fettblog.eu/php-browsersync-grunt-gulp/
    grunt.initConfig({
        watch: {
            php: {
                files: ['app/**/*.php']
            }
        },
        browserSync: {
            dev: {
                bsFiles: {
                    src: 'app/**/*.php'
                },
                options: {
                    proxy: '127.0.0.1:8010', //our PHP server
                    port: 8080, // our new port
                    open: true,
                    watchTask: true
                }
            }
        },
        php: {
            dev: {
                options: {
                    port: 8010,
                    base: 'app'
                }
            }
        }
    });

    grunt.registerTask('default', ['php', 'browserSync', 'watch']);
  
};