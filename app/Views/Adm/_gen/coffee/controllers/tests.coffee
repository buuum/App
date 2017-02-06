class testsController
  constructor: ->
    @events =
      'click a.addfase': 'addfase'
      'click a.deleterelation': 'deleterelation'
      'click a.addtext': 'addtext'

  deleterelation: (element) ->
    element.closest('.fasetext').find(".addtext").removeClass('hidden')
    element.closest('.relation').remove()
    return

  addfase: (element) ->
    $.get element.data('url'), (data) =>
      $clone = $(data)
      $('.fases').append $clone

      schema = element.attr 'data-schema'
      Utils.renumerar $('.fases').find('.fase'), schema
      
      return

  addtext: (element) =>
    $.get element.data('url'), (data) =>
      $div = $(data)
      element.closest("div").prepend($div)

      texts = element.closest(".fase").find(".texts")
      schema = element.attr 'data-schema'
      Utils.renumerar texts, schema

      schema = $(".addfase").attr 'data-schema'
      console.log schema
      Utils.renumerar $('.fases').find('.fase'), schema

      element.addClass 'hidden'
      Utils.iniSummernote()

    return

  