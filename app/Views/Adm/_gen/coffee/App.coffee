class App
  constructor: ->
    @kuv = new Kuv()

    @controller = new Controller()
    #    @controllers_page = ['actions', 'datatables', 'menu', 'images', 'tests', 'posts']
    @controllers_page = ['menu', 'datatables', 'actions', 'posts']

  ini: ->
    @kuv.buildMyEvents('Controller')
    @kuv.buildAllEvents(@controllers_page)
    return
