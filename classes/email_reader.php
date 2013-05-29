<?php

class email_reader {
 
    // imap server connection
    
    public $conn;
 
    // inbox storage and inbox message count

    private $inbox;
    private $msg_cnt;
 
    // email login credentials

    private $server = 'mail.jmcdesignstudios.com';
    private $user   = 'postmaster@jmcdesignstudios.com';
    private $pass   = '722c722c';
    private $port   = 143; // adjust according to server settings
 
    // connect to the server and get the inbox emails

    function __construct() {
        $this->connect();
        $this->inbox();
    }
 
    // close the server connection
    
    function close() {
        $this->inbox = array();
        $this->msg_cnt = 0;
        imap_close($this->conn);
    }
 
    // open the server connection

    // the imap_open function parameters will need to be changed for the particular server

    // these are laid out to connect to a Dreamhost IMAP server

    function connect() {
        $this->conn = imap_open('{'.$this->server.'/notls}', $this->user, $this->pass);
    }

    // flag the message for deletion

    function flagForDelete($msg_index) {
        //flag msg for deletion
        imap_delete($this->conn, $msg_index);
        echo "$msg_index flagged for deletion";
    }
  
    // delete inbox

   function delete() {
        echo $this->msg_cnt;
        imap_expunge($this->conn);
    }

    // get a specific message (1 = first email, 2 = second email, etc.)
    
    function get($msg_index) {
        if (isset($this->inbox[$msg_index])) 
        {
            return $this->inbox[$msg_index];
        }else
        {
        return false;
        }
    }

    // read the inbox

    function inbox() {
        $this->msg_cnt = imap_num_msg($this->conn);
        $in = array();
        for($i = 1; $i <= $this->msg_cnt; $i++) {
            $in[] = array(
                'index'     => $i,
                'header'    => imap_headerinfo($this->conn, $i),
              //'body'      => imap_body($this->conn, $i),
              //  'structure' => imap_fetchstructure($this->conn, $i)
            );
        }
        $this->inbox = $in;

    }
}

?>
