class menuController
  constructor: ->

    @events =
      'click .openmenu': 'showsidebar'

  showsidebar: (element) ->
    if $('.sidebar').position().left < 0
      $('.sidebar').css 'left', 0
      $('.navbar').css 'padding-left', '260px'
      $('.main-container').css 'padding-left', '260px'
    else
      $('.sidebar').css 'left', -270
      $('.navbar').css 'margin-left', 0
      $('.navbar').css 'padding-left', 0
      $('.main-container').css 'padding-left', 0
    return