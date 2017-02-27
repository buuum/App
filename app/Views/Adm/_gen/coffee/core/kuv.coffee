class Kuv
  constructor:->

    @alias = []
    # @setEvents()
    # @getAliasFunctions()

  getAllControllers:->
    App.controllers

  getAllModels: ->
    App.models

  getAliasFunctions: ->
    $.each @getAllModels(), ( index, value ) =>
      vars = Utils.get_class_methods window[value]
      @alias["#{value}"] = vars.functions
      return
    return

  getAliasName: (function_name) ->
    $.each @getAllModels(), ( index, value ) =>
      $.each @alias["#{value}"], (i,v) =>
        if v == function_name
          value


  getFunction: (ruta) ->

    parts = ruta.split(".")
    if parts.length == 2
      window[parts[0]][parts[1]]
    else if parts.length == 3
      window[parts[0]][parts[1]][parts[2]]
    else if parts.length == 4
      window[parts[0]][parts[1]][parts[2]][parts[3]]
    else if parts.length == 5
      window[parts[0]][parts[1]][parts[2]][parts[3]][parts[4]]
    else if parts.length == 6
      window[parts[0]][parts[1]][parts[2]][parts[3]][parts[4]][parts[5]]

  buildEvent: (i,vle,name) ->
    myarr = i.split(" ")
    prev = true
    if myarr[myarr.length-1] == 'notpreventdefault'
      prev = false
      myarr2 = myarr.slice(1,myarr.length-1).join(' ')
    else
      myarr2 = myarr.slice(1).join(' ')

    parts = vle.split(".")

    if myarr[0] == 'resize'
      @createResize(myarr2, parts, vle, name)
    else
      @createEvent(myarr, myarr2, parts, prev, vle, name)
    return

  createResize: (myarr2, parts, vle, name)->

    if myarr2 == 'window'
      $(window).resize =>
        @searchFunction parts, vle, name
    else
      $(myarr2).resize =>
        @searchFunction parts, vle, name

    return

  createEvent: (myarr, myarr2, parts, prev, vle, name)->
    $('body').on myarr[0], myarr2, (e) =>
      if prev
        e.preventDefault()
      @searchFunctionEvent parts, vle, e, name
      return
    return

  searchFunctionEvent: (parts, vle, e, name)->
    if parts[1]
      if parts[0] != 'Utils' && parts[0] != 'App'
        if name == 'Controller'
          parts.unshift 'App','controller'
        else if parts[0] != name
          parts.unshift name

      if parts.length == 2
        window[parts[0]][parts[1]]($(e.currentTarget), e)
      else if parts.length == 3
        window[parts[0]][parts[1]][parts[2]]($(e.currentTarget), e)
      else if parts.length == 4
        window[parts[0]][parts[1]][parts[2]][parts[3]]($(e.currentTarget), e)
      else if parts.length == 5
        window[parts[0]][parts[1]][parts[2]][parts[3]][parts[4]]($(e.currentTarget), e)
      else if parts.length == 6
        window[parts[0]][parts[1]][parts[2]][parts[3]][parts[4]][parts[5]]($(e.currentTarget), e)

    else
      if name == 'Controller'
        App.controller[vle]($(e.currentTarget), e)
      else
        if window[name]?
          window[name][vle]($(e.currentTarget), e)
        else if App[name]?
          App[name][vle]($(e.currentTarget), e)

  searchFunction: (parts, vle, name)->
    if parts[1]
      if parts[0] != 'Utils' && parts[0] != 'App'
        if name == 'Controller'
          parts.unshift 'App','controller'
        else if parts[0] != name
          parts.unshift name

      if parts.length == 2
        window[parts[0]][parts[1]]()
      else if parts.length == 3
        window[parts[0]][parts[1]][parts[2]]()
      else if parts.length == 4
        window[parts[0]][parts[1]][parts[2]][parts[3]]()
      else if parts.length == 5
        window[parts[0]][parts[1]][parts[2]][parts[3]][parts[4]]()
      else if parts.length == 6
        window[parts[0]][parts[1]][parts[2]][parts[3]][parts[4]][parts[5]]()

    else
      if name == 'Controller'
        App.controller[vle]()
      else
        if window[name]?
          window[name][vle]()
        else if App[name]?
          App[name][vle]()

  setEvents: ->

    if App.controller.events?
      events = App.controller.events

      $.each events, ( i, vle ) =>
        @buildEvent(i, vle, 'Controller')
        return

    $.each @getAllControllers(), ( index, value ) =>
      events = false
      if window[value].events?
        events = window[value].events
      if events
        $.each events, ( i, vle ) =>
          @buildEvent(i, vle, value)

    return

  buildAllEvents: (events) ->
    if events.length > 0
      $.each events, (i,el) =>
        name = "#{el}C"
        namec = "#{el}Controller"
        App[name] = new window[namec]()
        @buildMyEvents(name)
        return
    return

  buildMyEvents: (name) ->
    events = false
    if name == 'Controller'
      if App.controller.events?
        events = App.controller.events

        $.each events, ( i, vle ) =>
          @buildEvent(i, vle, 'Controller')
          return
    else
      if window[name]?
        events = window[name].events
      else if App[name]?
        events = App[name].events

      if events
        $.each events, ( i, vle ) =>
          @buildEvent(i, vle, name)

    return
