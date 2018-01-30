class @Notification
  constructor: ->
    @checkPermissions()

  checkPermissions: ->
    if !Notify.needsPermission
      @notify new Message('Test.')
    else if Notify.isSupported()
      @notify new Message('sldkf', 'lskdfj')
      #https://developer.mozilla.org/en-US/docs/Web/API/Notifications_API/Using_the_Notifications_API
      #Notify.requestPermission @onPermissionGranted, @onPermissionDenied

  onPermissionGranted: ->
    #title = Helper.param 'title'
    #body = Helper.param 'body'
    s = '#notification.index';
    title = $("#{s} .title").val()
    body = $("#{s} .body").val()
    @notify new Message(title, body)

   onPermissionDenied: ->
    #@notify new Message('Notification permission denied.')
    console.log 'Notification permission denied.'

  notify: (message) ->
    params = {
      body: message.body,
      notifyShow: @onNotify,
      notifyError: @onNotifyError
      timeout: 5
    }
    console.log 'xxx ', message.title, params
    new Notify(message.title, params).show()

  onNotify: -> console.log 'Notified.'

  onNotifyError: (e) -> console.log 'Notification error.', e

$(document).ready -> new Notification()