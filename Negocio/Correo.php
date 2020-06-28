<?php 

class Correo{

    private $to;
    private $from;
    private $asunto;
    private $msj;
    private $cc;
    private $Bcc;

    public function Correo($to = "", $from = "", $asunto = "", $msj = "", $cc = "", $Bcc = ""){
        $this -> to = $to;
        $this -> from = $from;
        $this -> asunto = $asunto;
        $this -> msj = $msj;
        $this -> cc = $cc;
        $this -> Bcc = $Bcc;
    }

    /* 
     * GETS
     */

    public function getTo(){
        return $this -> to;
    }
    public function getFrom(){
        return $this -> from;
    }
    public function getAsunto(){
        return $this -> asunto;
    }
    public function getMsj(){
        return $this -> msj;
    }
    public function getCc(){
        return $this -> cc;
    }
    public function getBcc(){
        return $this -> Bcc;
    }

    /*
     * SETS
     */

    public function setTo($to){
        $this -> to = $to;
    }
    public function setFrom($from){
        $this -> from = $from;
    }
    public function setAsunto($asunto){
        $this -> asunto = $asunto;
    }
    public function setMsj($msj){
        $this -> msj = $msj;
    }
    public function setCc($cc){
        $this -> cc = $cc;
    }
    public function setBcc($Bcc){
        $this -> Bcc = $Bcc;
    }

    /*
     * Methods
     */

    public function send(){
        $header = array(
            "From" => $this -> from,
            "CC" => $this -> cc,
            "Bcc" => $this -> Bcc
        );
        $res = mail($this -> to, $this -> asunto, $this -> msj, $header);

        return $res;
    }

}

?>