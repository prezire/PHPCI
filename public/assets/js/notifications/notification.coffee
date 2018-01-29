class Notification
  constructor: ->
    @checkPermissions()

  checkPermissions: ->
    if !Notify.needsPermission
      #Do nothing.
    else if Notify.isSupported()
      Notify.requestPermission @onPermissionGranted, @onPermissionDenied

  onPermissionGranted: ->
    title = Helper.param 'title'
    body = Helper.param 'body'
    @notify new Message(title, body)

   onPermissionDenied: ->
    @notify new Message('Notification permission denied.')

  notify: (message) ->
    params = {
      body: message.body,
      notifyShow: @onNotify,
      timeout: 5
    }
    new Notify(message.title, parmas).show()

  #onNotify: -> console.log 'Notified.'

$(document).ready -> new Notification()