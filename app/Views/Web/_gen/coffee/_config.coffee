class Config
  constructor: ->
    @varconfigs =
      version: '0.0.1'

  get: (attr) ->
    @varconfigs[attr]

  set: (attr, value) ->
    @varconfigs[attr] = value
    return

Config = new Config()
