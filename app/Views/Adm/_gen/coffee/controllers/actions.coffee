class actionsController
  constructor: ->
    @events =
      'click .showdelete': 'showmodal'
      'click .deleteitem': 'removeItem'
      'click .cancelitem': 'closeModal'

    @modal = false

  showmodal: (element) ->
    @modal = new modalbox()

    @modal.setOptions
      ajax: element.attr 'href'
      show: 'show_buuummodal_from_top'
      close: 'hide_buuummodal_top'

    @modal.ini()
    return

  removeItem: (element) ->
    Api.deleteData
      url: element.attr('href')
    , (response) =>
      if !response.error
        $("#item#{response.id}").remove()
        @modal.close()
      return
    return

  closeModal: (element) ->
    @modal.close()
    return