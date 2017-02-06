class Controller
  constructor: ->

    @events =
    #   'resize window': 'App.views.resizeValues'
    #   'click a.backbutton': 'closePage'
      'click .blockload notpreventdefault': 'Utils.blockload'
    #   'click a#startapp': 'closeTutorial'
