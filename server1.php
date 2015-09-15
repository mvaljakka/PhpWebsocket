<?php
require_once('./serverclass.php');
class myServer extends WebSocketServer {
  
  // simple test server
  // on handshake: responds with {"id":"xxxx"}
  // then echos messages to everyone as such
  
  //protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.
  
  protected function process ($user, $message) {
    foreach ($this->users as $id=>$u)
       $this->send($u,$message);
  }
  
  protected function connected ($user) {
    $json = '{"id":"'.$user->id.'"}';
    $this->send($user,$json);
	print "welcomed client ".$json."\n";
  }
  
  protected function closed ($user) {
    print "killed client ".$user->id."\n";
  }
}
$my = new myServer("0.0.0.0","9000");
try {
  $my->run();
}
catch (Exception $e) {
  $echo->stdout($e->getMessage());
}
?>
