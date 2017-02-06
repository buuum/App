class imagesController
  constructor: ->
    @events =
      'click a#uploadimage_': 'uploadimage_'
      'click a.deleteimage': 'delete'

    if $('.uploadimagemultiple').length > 0
      @iniuploadmultiple($('.uploadimagemultiple'))

    if $('.uploadimage').length > 0
      @iniupload($('.uploadimage'))


  iniupload: (element) ->
    element.liteUpload
      script: element.next('a').attr('href')
      onClick: (button) ->
        #        console.log button
        return true
      onBefore: (button) ->
        button.next('img').attr 'src', ''
        button.nextAll('input').first().val ''
        return true
      onEnd: (button) ->
        #        console.log button
        return
      onSuccess: (response, fileactual, button) ->
        if !response.error
          button.next('img').attr 'src', response.url.default
          button.nextAll('input').first().val response.url.default
        else
          alert response.message
    #        console.log response, fileactual, button

    return


  iniuploadmultiple: (element) ->

    element.liteUpload
      script: element.next('a').attr('href')
      onClick: (button) ->
        # console.log button
        return true
      onSelectFiles: (files) ->
        $('#showimage').attr 'src', ''
        $('input[name="url"]').val ''
        return true
      onProgress: (percent, fileactual, filetotal) ->
        # console.log percent, fileactual, filetotal
        return true
      onEnd: (button) ->
        # console.log button
        return
      onSuccess: (response, fileactual, button) =>
        if !response.error
          # Clonar el div
          $.get button.data('url'), (data) =>
            $clone = $(data)

            $clone.find("img").attr 'src', response.url.default
            $clone.find("input").val response.url.default

            $('.listuploads').append $clone

            # Renumerar divs
            schema = button.attr 'data-schema'
            regex = new RegExp schema

            images = button.next(".listuploads").find(".image")

            Utils.renumerar images, schema

          
        else
          alert response.message
    return

  delete: (element) ->
    console.log "Eliminar"
    element.parent().remove()
    return
