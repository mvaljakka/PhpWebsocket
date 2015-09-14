# PhpWebsocket
Generic PHP Websocket server for chat, games, other synchronous interaction... HTML5 demo clients included

This application is based on <b> Adam Alexander's https://github.com/ghedipunk/PHP-Websockets/ </b> <br/>
Download it first.

See also http://www.phpbuilder.com/articles/application-architecture/optimization/creating-real-time-applications-with-php-and-websockets.html

- See websocket.pdf -tiedostoon, intro to Websockets (in Finnish) + demoserver protocols (simple & advanced)

- Simple chat client; code: server1.php (ws://www.anycase.info:9000   and   www.anycase.info/websocket/chatclient.html)

- Advanced chat client; code: server2.php (ws://www.anycase.info:9001   ja   www.anycase.info/websocket/chatclient2.html)

- try and use for free

Files:<br/>
testclient -- websocket handshake <br/>
chatclient -- basic chat, simple server <br/>
chatclient2 -- chat + simple board game (with no game logic) <br/>
serverclass.php -- server code from https://github.com/ghedipunk/PHP-Websockets/ <br/>
users.php -- user class (addded nickname and channel) <br/>
server1.php - simple chat server <br/>
server2.php - advanced server (channel,nickname; LIST (who is online); JOINED-viesti (who entered channel);<br/> 
   KILLED (who left channel)


