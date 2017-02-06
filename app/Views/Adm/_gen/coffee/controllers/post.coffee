class postsController
  constructor: ->
    @events =
      'click a.additem': 'additem'
      'click a.delete_item': 'removeitem'

  removeitem: (element) ->
    element.closest('.item_list').remove()
    return

  additem: (element) ->
    parents = element.parents('.item_list')

    $.get element.attr('href'), (data) =>
      schema = element.attr 'data-schema'
      elements = element.closest('.list_items')
      elements.find('.content-items').eq(0).append $(data)
      $data = elements.find('.content-items').eq(0).find('> .item_list')
      @renumerar $data, schema

      if parents.length > 0
        $.each parents, (i, el) =>
          $data = $(el).find('.content-items').eq(0).find('> .item_list')
          schema = $(el).closest('.list_items').find('.additem').last().attr('data-schema')
          num = $(el).closest('.content-items').find('> .item_list').index($(el))
          @renumerar $data, schema, num
          return


  renumerar: (divs, schema, num = null) ->
    # Renumerar divs
    regex = new RegExp schema

    $.each divs, (indice, div) =>
      $.each $(div).find('[name]'), (i, el) =>
        name = $(el).attr('name')
        indice = num if num != null
        name = name.replace(regex, "$1#{indice}$3")
        $(el).attr 'name', name
        return
