module.exports = (grunt) ->
  grunt.file.expand('node_modules/grunt-*/tasks').forEach grunt.loadTasks

  options =
    public: 'httpdocs'
    tmp: '_tmpgen'
    folder: 'web2'
    modulo: ''
    command: ''
    action: false
    dest: false
    file: false
    gittype: 'view'
    user: 'anonymous'

  grunt.initConfig
    pkg: grunt.file.readJSON('package.json')
    cfg: options

    mkdir:
      all:
        options:
          create: ['modulos/<%= cfg.modulo %>/Entities', 'modulos/<%= cfg.modulo %>/Repositories']

    bower:
      dev:
        options:
          expand: true
          packageSpecific:
            'chosen':
              files: [
                "chosen-sprite.png",
                "chosen-sprite@2x.png",
                "chosen.jquery.js",
                "chosen.css"
              ]
            'font-awesome':
              files: [
                "css/font-awesome.css",
                "fonts/*"
              ]
            'bootstrap':
              files: [
                "dist/css/bootstrap.min.css",
                "dist/js/bootstrap.min.js",
                "dist/fonts/*"
              ]
            'summernote':
              files: [
                "dist/summernote.js",
                "dist/summernote.css"
                "dist/font/*"
              ]
            'moment':
              files: [
                "min/moment-with-locales.min.js"
              ]
        dest: '<%= cfg.public %>/assets/plugins'

    exec:
      fonts:
        cmd: "php task grunt bower"
      template:
        cmd: "php task grunt template <%= cfg.folder %> <%= cfg.file %>"
      templatechars:
        cmd: "php task grunt templatechars <%= cfg.folder %> <%= cfg.file %>"
      updateversion:
        cmd: "php task grunt updateversion"

    uglify:
      plugins:
        files: [
          expand: true,
          cwd: '<%= cfg.public %>/assets/plugins',
          src: ['**/*/*.js', '!minify/**'],
          dest: '<%= cfg.public %>/assets/plugins/minify'
        ]
      app:
        files:
          '<%= cfg.public %>/assets/<%= cfg.folder %>/js/main.js': '<%= cfg.tmp %>/js/main1.js'


    haml:
      dist:
        expand: true
        cwd: "app/Views/<%= cfg.folder %>/_gen/views"
        src: ['**/*.haml']
        dest: 'app/Views/<%= cfg.folder %>/public'
        ext: '.php'
      one:
        expand: true
        cwd: "app/Views/<%= cfg.folder %>/_gen/views"
        src: ['<%= cfg.file %>.haml']
        dest: 'app/Views/<%= cfg.folder %>/public'
        ext: '.php'

    coffee:
      compile:
        options:
          bare: true
        expand: true
        cwd: "app/Views/<%= cfg.folder %>/_gen/coffee"
        src: "**/**/*.coffee"
        dest: "<%= cfg.tmp %>/js"
        ext: '.js'


    concat:
      js:
        src: '<%= cfg.tmp %>/js/**/*.js'
        dest: '<%= cfg.tmp %>/js/main1.js'

    clean:
      tmp: ["<%= cfg.tmp %>"]
      public: ["<%= cfg.public %>/<%= cfg.folder %>"]
      cache: ["<%= cfg.public %>/../temp/assets/*"]

    cssmin:
      target:
        files:
          '<%= cfg.public %>/assets/<%= cfg.folder %>/css/main.css': '<%= cfg.tmp %>/css/app.css'

    compass:
      dist:
        options:
          imagesDir: "assets/<%= cfg.folder %>/imgs"
          sassDir: "app/Views/<%= cfg.folder %>/_gen/sass"
          cssDir: "<%= cfg.tmp %>/css"

    htmlmin:
      dist:
        options:
          removeComments: true
          collapseWhitespace: true
          caseSensitive: true
        expand: true
        cwd: "app/Views/<%= cfg.folder %>/public"
        src: ['**/*.php']
        dest: "app/Views/<%= cfg.folder %>/public"
      one:
        options:
          removeComments: true
          collapseWhitespace: true
          caseSensitive: true
        expand: true
        cwd: "app/Views/<%= cfg.folder %>/public"
        src: ['<%= cfg.file %>.php']
        dest: "app/Views/<%= cfg.folder %>/public"

    watch:
      sass:
        files: ['app/**/*.sass']
        tasks: ['buildsass:<%= cfg.folder %>']
        options:
          spawn: false
          interrupt: false
      cofffee:
        files: ['app/**/*.coffee']
        tasks: ['buildcoffee:<%= cfg.folder %>']
        options:
          spawn: false
          interrupt: false
      haml:
        files: ['app/**/*.haml']
        tasks: ['buildhaml:<%= cfg.folder %>:<%= cfg.file %>']
        options:
          spawn: false
          interrupt: false

    copy:
      folders:
        expand: true
        cwd: "app/Views/<%= cfg.folder %>/_gen"
        src: ['**', '!coffee/**', '!sass/**', '!views/**'],
        dest: "<%= cfg.public %>/assets/<%= cfg.folder %>"


  grunt.registerTask 'installplugins', ['bower', 'exec:fonts', 'uglify:plugins']

  grunt.registerTask 'buildhaml', 'Generamos HAML', (folder, file = false) =>
    options.folder = folder
    if file
      options.file = file
      grunt.task.run ['haml:one', 'exec:template', 'htmlmin:one', 'exec:templatechars']
    else
      options.file = false
      grunt.task.run ['haml:dist', 'exec:template', 'htmlmin:dist', 'exec:templatechars']
    return

  grunt.registerTask 'buildcoffee', 'Generamos Coffee', (folder) =>
    options.folder = folder
    grunt.task.run ['coffee', 'concat:js', 'uglify:app', 'clean:tmp', 'clean:cache', 'exec:updateversion']
    return

  grunt.registerTask 'buildsass', 'Generamos SASS', (folder) =>
    options.folder = folder
    grunt.task.run ['compass', 'cssmin', 'clean:tmp', 'clean:cache', 'exec:updateversion']
    return

  grunt.registerTask 'buildassets', 'copiamos todo lo no autogenerado', (folder) =>
    options.folder = folder
    grunt.task.run ['copy']
    return

  grunt.registerTask 'build', 'Generamos All', (folder) =>
    options.folder = folder
    options.file = false
    grunt.task.run ['clean', 'copy', 'compass', 'cssmin', 'clean:tmp', 'clean:cache', 'coffee', 'concat:js',
      'uglify:app', 'clean:tmp', 'clean:cache', 'haml:dist', 'exec:template', 'htmlmin:dist', 'exec:templatechars',
      'exec:updateversion']
    return


  grunt.event.on 'watch', (action, filepath) =>
    # grunt.log.writeln(': ' + filepath + ' has ' + action)
    if process.platform == "win32"
      parts = filepath.split("\\")
    else
      parts = filepath.split("/")

    file = parts.pop()
    file = file.split(".")
    ext = file.pop()
    namefile = file.join(".")
    if ext == 'haml'
      part = parts.pop()
      ruta = []
      while part != 'views'
        ruta.push part
        part = parts.pop()

      if ruta.length > 0
        ruta.reverse()
        namefile = ruta.join('/') + '/' + namefile

    #    grunt.log.writeln namefile
    #    grunt.log.writeln parts[1]
    #    grunt.log.writeln parts
    options.file = namefile
    options.folder = parts[2]
    return
