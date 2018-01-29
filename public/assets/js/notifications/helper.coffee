class Helper
  constructor: -> #

  @param: (name, url) ->
    if !url then url = window.location.href
    name = name.replace(/[\[\]]/g, "\\$&")
    regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)")
    results = regex.exec(url);
    if (!results) then return null
    if (!results[2]) then return ''
    decodeURIComponent(results[2].replace(/\+/g, " "))