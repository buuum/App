class homeController
  constructor: ->
    @events =
      'click .openfullmenu': 'openfullmenu'
      'click .close_menu': 'close_menu'
      'click .closecookies': 'closecookiesalert'
      'click .btn-view-campanas': 'viewcampanas'

    #    preload
    #    $('#preloader').delay(3000).fadeOut 'slow', ->
    #      $(this).remove()

    if $('.header-fullscreen').length > 0
      $('.header-fullscreen').css 'height', $(window).height() * 0.60
      $(window).resize ->
        $('.header-fullscreen').css 'height', $(window).height() * 0.60
        return

    $(window).on 'scroll', ->
      pos = $(window).scrollTop()
      if pos > 0
        $('.sticky-wrapper').addClass 'is-sticky'
        $('.navbar-custom').css 'position', 'fixed'
        $('.navbar-custom').css 'top', 0
      else
        $('.sticky-wrapper').removeClass 'is-sticky'
        $('.navbar-custom').css 'position', 'relative'
      return

    @modal = null

  viewcampanas: (element) ->
#    $(document).scrollTop($("#campanas").offset().top)
    x = $('#campanas').offset().top - 75;
    $('html,body').animate({scrollTop: x}, 400)
    return

  close_menu: (element) ->
    @modal.close()
    return

  openfullmenu: (element) ->
    @modal = new modalbox()
    @modal.setOptions
      ajax: element.attr('data-menu')
      width: '100%'
      show: 'show_buuummodal_from_top'
      close: 'hide_buuummodal_top'
      overlaycolor: '#000'
    @modal.ini()
    return

  closecookiesalert: ->
    console.log "close"
    $("#cookiesalert").addClass 'hidden'
    return