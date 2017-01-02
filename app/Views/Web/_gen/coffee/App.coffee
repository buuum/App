class App
  constructor: ->
    @kuv = new Kuv()

    @controller = new Controller()
    @controllers_page = ['home']

  ini: ->
    @kuv.buildMyEvents('Controller')
    @kuv.buildAllEvents(@controllers_page)
    return
