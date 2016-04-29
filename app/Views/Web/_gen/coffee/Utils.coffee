class Utils
  constructor:->

  @getObjJson: ($obj) ->
    $objjson = false
    if $obj
      $objjson = $.extend {}, $obj, Config.get 'lang_obj'
    if Config.get('user_storage') && $objjson
      $objjson = $.extend {}, $objjson, Config.get 'user_storage'
    else if Config.get 'user_storage'
      $objjson = $.extend {}, Config.get('user_storage'), Config.get 'lang_obj'
    if !$objjson
      $objjson = Config.get 'lang_obj'
    $objjson

  @merge: (obj1 = {}, obj2 = {}) ->
    $.extend {}, obj1, obj2

  @blockload: (btn) ->
    btn.addClass 'disabled'
    oldtext = btn.find('span').text()
    btn.find('span').text btn.data('disabledtext')
    btn.data 'disabledtext', oldtext
    return

  @unblockload: (btn) ->
    oldtext = btn.find('span').text()
    btn.find('span').text btn.data('disabledtext')
    btn.data 'disabledtext', oldtext
    btn.removeClass 'disabled'
    return

  @scrollanimate: (container, coordinates) =>
    style = "all 300ms ease-out"
    stylepos = "translateX(" + coordinates + "px)"

    @setStyles container, {
      "-webkit-transition": "-webkit-" + style
      "-moz-transition": "-moz-" + style
      "-ms-transition": "-ms-" + style
      "-o-transition": "-o-" + style
      "transition": style
      "-webkit-transform": stylepos
      "-moz-transform": stylepos
      "-ms-transform": stylepos
      "-o-transform": stylepos
      "transform": stylepos
    }

    if container[0]?

      container.one "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", =>
        @setStyles container, {
          "-webkit-transition": ""
          "-moz-transition": ""
          "-ms-transition": ""
          "-o-transition": ""
          "transition": ""
        }
        return


    else

      container.addEventListener "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", (e) =>
        e.target.removeEventListener e.type, ->
          return
        , false
        @setStyles container, {
          "-webkit-transition": ""
          "-moz-transition": ""
          "-ms-transition": ""
          "-o-transition": ""
          "transition": ""
        }
        return
      , false


    return

  @scrollanimateopacity: (container, coordinates) =>
    style = "all 300ms ease-out"
    stylepos = coordinates

    @setStyles container, {
      "-webkit-transition": "-webkit-" + style
      "-moz-transition": "-moz-" + style
      "-ms-transition": "-ms-" + style
      "-o-transition": "-o-" + style
      "transition": style
      "opacity": stylepos
    }

    container.one "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", =>
      @setStyles container, {
        "-webkit-transition": ""
        "-moz-transition": ""
        "-ms-transition": ""
        "-o-transition": ""
        "transition": ""
      }
      return
    if coordinates == 0
      container.css 'display','hidden'

    return

  @setStyles: (element, styles) =>
    for own property, value of styles
    # for property in styles
      if styles.hasOwnProperty property
        value = styles[property]

        if property == 'marginTop'
          value += "px"

        if element[0] == undefined
          element.style[property] = value
        else
          element[0].style[property] = value

    return element

  @scroll: (container, coordinates) =>

    style = "translateX(" + coordinates + "px)"

    @setStyles container, {
      "-webkit-transform": style
      "-moz-transform": style
      "-ms-transform": style
      "-o-transform": style
      "transform": style
    }

    return

  @round: (value, precision, mode) ->
    precision |= 0;
    m = Math.pow(10, precision);
    value *= m;
    sgn = (value > 0) | -(value < 0);
    isHalf = value % 1 == 0.5 * sgn;
    f = Math.floor(value);

    if isHalf
      if mode == 'PHP_ROUND_HALF_DOWN'
        value = f + (sgn < 0);
      else if mode == 'PHP_ROUND_HALF_EVEN'
        value = f + (f % 2 * sgn);
      else if mode == 'PHP_ROUND_HALF_ODD'
        value = f + !(f % 2);
      else
        value = f + (sgn > 0);

    valor = if isHalf then value else Math.round value
    valor / m


  @isset: ->
    a = arguments
    l = a.length
    i = 0

    if l == 0
      return
    while i != l
      if a[i] == undefined || a[i] == null
        return false
      i++
    return true

  @realSizes: (obj, objsize = false) ->
    width_ = window.innerWidth
    height_ = window.innerHeight

    clone = obj.clone()
    clone.css "visibility", "hidden"
    clone.css "display", "inline-block"
    $('body').append clone
    if objsize
      width = clone.find(objsize).outerWidth()
      height = clone.find(objsize).outerHeight()
    else
      width = clone.outerWidth()
      height = clone.outerHeight()
    clone.remove()
    {
      window_w: width_
      window_h: height_
      width: width
      height: height
    }

  @get_class_methods: (name) ->
    constructor = undefined
    retArr = []
    method = ''

    if typeof name == 'function'

      constructor = name
      consname = "#{constructor.name}"

    else if typeof name == 'string'

      constructor = @window[name]
      consname = "#{name}"

    else if typeof name == 'object'

      constructor = name

      consname = "#{constructor.constructor.name}"

      for method of constructor.constructor
        `method = method`
        if typeof constructor.constructor[method] == 'function'
          # retArr[method] = constructor.constructor[method]
          retArr.push method

    for method of constructor
      `method = method`
      if typeof constructor[method] == 'function'
        # retArr[method] = constructor[method]
        retArr.push method

    for method of constructor.prototype
      `method = method`
      if typeof constructor.prototype[method] == 'function'
        # retArr[method] = constructor.prototype[method]
        retArr.push method

    {
      classname: consname
      functions: retArr
    }

  @serializeObject: (obj) ->
    o = {};
    a = obj.serializeArray()

    $.each a, ->
      if o[this.name]?
        if !o[this.name].push
          o[this.name] = [o[this.name]]
        o[this.name].push this.value || ''
      else
        o[this.name] = this.value || ''
      return
    o
