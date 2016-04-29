class ApiService
  constructor: ->
    @cache = []

  call: (datastring, options = {}) ->

    defaultoptions =
      timeout : 0
      headers: false
      method: "POST"
      url: false

    options = Utils.merge defaultoptions, options

    Config.set 'ajaxLoad', $.ajax
      type: options.method
      url: if options.url then options.url else Config.get 'server'
      data: datastring
      dataType: "json"
      timeout: options.timeout
      beforeSend: (xhr) =>
        if options.headers
          xhr.setRequestHeader "#{options.headers.name}",  "Bearer #{options.headers.value}"
        return
    Config.get 'ajaxLoad'

  call2: (options) ->
    Config.set 'ajaxLoad', $.ajax
      type: options.method
      url: if options.url then options.url else Config.get 'server'
      data: options.params
      dataType: "json"
      timeout: options.timeout
      beforeSend: (xhr) =>
        if options.headers
          xhr.setRequestHeader "#{options.headers.name}",  "Bearer #{options.headers.value}"
        return
    Config.get 'ajaxLoad'

  callAjax: (options, callback) ->

    # headers = {}
    # if User.isLogin()
    #   options.headers =
    #     name: 'Authorization'
    #     value: User.userinfo.userinfo.header

    @call2(options)
    .success (data) =>
      @saveCahe options.cache, data if options.cache.save
      return callback data if callback
      data
    .error (xhr) =>
      return callback xhr if callback
      xhr

  clearAllLocalData: ->
    localStorage.clear()
    return

  removeLocalData: ($key) ->
    localStorage.removeItem $key
    return

  setLocalData: ($key, $value, $nojson = false) ->
    if $nojson
      localStorage.setItem $key, $value
    else
      localStorage.setItem $key, JSON.stringify $value
    return

  getLocalData: ($key, $nojson = false) ->
    info = localStorage.getItem $key
    if info != null && info != undefined
      if $nojson
        salida = info
      else
        salida = JSON.parse info
    else
      salida = false
    return salida

  getData: (options, callback) ->
    defaultoptions =
      timeout: 0
      headers: false
      method: "GET"
      url: Config.get "server"
      cache:
        save: false
        name: false
        sublist: false
      params: {}

    options = Utils.merge defaultoptions, options

    if options.cache.name && @cache.hasOwnProperty options.cache.name
      values = @cache[options.cache.name]
      return callback values if callback
      values
    else
      @callAjax options, callback

  setData: (options, callback) ->
    defaultoptions =
      timeout: 0
      headers: false
      method: "POST"
      url: Config.get "server"
      cache:
        save: false
        name: false
        sublist: false
      params: {}

    options = Utils.merge defaultoptions, options

    @callAjax options, callback

  updateData: (options, callback) ->
    defaultoptions =
      timeout: 0
      headers: false
      method: "PUT"
      url: Config.get "server"
      cache:
        save: false
        name: false
        sublist: false
      params: {}

    options = Utils.merge defaultoptions, options

    @callAjax options, callback

  deleteData: (options, callback) ->
    defaultoptions =
      timeout: 0
      headers: false
      method: "DELETE"
      url: Config.get "server"
      cache:
        save: false
        name: false
        sublist: false
      params: {}

    options = Utils.merge defaultoptions, options

    @callAjax options, callback

  saveCahe: (cache, data) ->
    @cache[cache.name] = data
    @saveSublist cache, data if cache.sublist
    return

  saveSublist: (cache, data) ->

    list = data[cache.sublist[0]]
    name = cache.sublist[1][1]
    cache_name = cache.sublist[1][0]
    sublist = if cache.sublist[1][2] then cache.sublist[1][2] else false

    $.each list, (i,el) =>
      if sublist
        @cache[cache_name+el["#{name}"]] =
          "#{sublist}": el[sublist]
      else
        @cache[cache_name+el["#{name}"]] = el
      return
    return

Api = new ApiService();
