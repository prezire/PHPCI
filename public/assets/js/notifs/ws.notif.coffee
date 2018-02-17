###
WebSocket Notification class.
Refer to layout view:
<span id="notif">
  <input type="hidden" class="host" value="ws://localhost:8080" />
  <input type="hidden" class="topic" value="projects" />
</span>
###
class @WsNotif
  constructor: (wsUri, @topicUri) ->
    @conn = new ab.Session wsUri, 
      @onSessOpen, 
      @onSessClose, 
      {'skipSubprotocolCheck': true}

  onSub: (topic, data) ->
    #This is where you would add the new article to the DOM 
    #(beyond the scope of this tutorial)
    if Notify.isSupported()
      Notify.requestPermission @onPermGranted, @onPermDenied
    else
      new Notify(topic, {body: data.message}).show()

  onSessOpen: -> @conn.subscribe @topicUri, @onSub

  onSessClose: -> console.warn 'WebSocket connection closed.'

  onPermGranted: -> #Do nothing.
  
  onPermDenied: -> #Do nothing.

$(document).ready -> 
  new WsNotif $('#notif .host').val(), $('#notif .topic').val()