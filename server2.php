<?php
require_once('./serverclass.php');
class myServer extends WebSocketServer {
  
  //protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.
  
  protected function process ($user, $message) {
    print "We got: $message\n";
    $m = json_decode($message);
    if ($user->channel == "")   // no channel: first message from this client
    {  $user->channel = $m->channel;    // set channel
       $user->nickname = $m->nickname;  // set nickname
       // send others in channel a JOINED message
       // send JOINED for all in same channel
       $foo=array();
       $foo["id"] = $user->id;
       $foo["channel"]=$user->channel;
       $foo["nickname"]=$user->nickname;
       $foo["message"]="JOINED";
       $message=json_encode($foo);
       foreach ($this->users as $id=>$u)
          if (($u->channel == $user->channel) && ($user->id != $u->id))
             $this->send($u,$message);
    }   
    // is this a LIST request?
    if ($m->message == "LIST")
    {  $s = "LIST";
       foreach ($this->users as $id=>$u)
          if ($u->channel == $m->channel)
             $s .= ",".$u->nickname;
       $m->message = $s;
       $message = json_encode($m);
       $this->send($user,$message);
    } 
    else 
    {  // echo back to all on same channel
       foreach ($this->users as $id=>$u)
          if ($u->channel == $m->channel)
             $this->send($u,$message);
       print "We sent: $message\n";
    }
  }
  
  // new client: send {"id":"id"}
  protected function connected ($user) {
    $json = '{"id":"'.$user->id.'"}';
    $this->send($user,$json);
	print "welcomed client ".$json."\n";
  }
  
  protected function closed ($user) {
    $m=array();
    $m["id"]=$user->id;
    $m["channel"]=$user->channel;
    $m["nickname"]=$user->nickname;
    $m["message"]="KILLED";
    $message=json_encode($m);
    foreach ($this->users as $id=>$u)
       if ($u->channel == $user->channel)
         $this->send($u,$message);
    print "killed client ".$user->id." with message $message\n";
  }
}
$my = new myServer("0.0.0.0","9001");
try {
  $my->run();
}
catch (Exception $e) {
  $echo->stdout($e->getMessage());
}
