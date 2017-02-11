class actionsController
  constructor: ->
    @events =
      'click .showdelete': 'showmodal'
      'click .deleteitem': 'removeItem'
      'click .cancelitem': 'closeModal'

    @modal = false

    @iniDatetime()
    @iniSummernote()
    if $('.liteupload').length > 0
      @iniUpload()


  iniUpload: ->

    $url = $('.liteupload').data 'url'

    $('.liteupload').liteUpload
      script: $url
      onClick: (button) ->
#        console.log 'click'
        true
      onSelectFiles: (files) ->
#        console.log files
        true
      onSuccess: (response, fileactual, button) ->
#        console.log(response);
#        console.log(button);
        button.closest('div').find('img').attr 'src', response.url.default
        button.closest('div').find('input.url-img').val response.url.default
        return
    return

  iniSummernote: ->
    $('.summernote').summernote
      styleWithSpan: false
      height: 300
    return

  iniDatetime: ->
    if $('.datetimepicker').length > 0
      $('.datetimepicker').datetimepicker
        locale: 'es'
        format: 'DD/MM/YYYY HH:mm:ss'


#      $('body').on 'focus', ".datetimepicker", ->
#        $(this).datetimepicker
#          locale: 'es'
#          format: 'DD/MM/YYYY HH:mm:ss'
    return

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