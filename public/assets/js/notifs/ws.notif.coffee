###
WebSocket Notification class.
Refer to layout view.
###
class @WsNotif
  constructor: (wsUri, topicUri) ->
    protocol = if window.location.protocol is 'http:' then 'ws:' else 'wss:'
    wsUri = "#{protocol}//#{wsUri}"
    ctx = @
    conn = new ab.Session wsUri, 
      -> 
        conn.subscribe(topicUri, ctx.onSub)
      ,
      -> console.log('something went wrong.'),
      {'skipSubprotocolCheck': true}

  onSub: (topic, data) ->
    console.log topic, data

$(document).ready -> 
  new WsNotif $('#push-notif').data('host'), $('#push-notif').data('topic')