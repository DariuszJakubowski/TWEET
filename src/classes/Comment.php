<?php

class Comment
{
    private $id;
    private $text;
    private $id_user;
    private $id_tweet;
    private $creation_date;


    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }
    
    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setId_tweet($id_tweet) {
        $this->id_tweet = $id_tweet;
    }

    public function addComment(mysqli $conn) {
        $stmt = $conn->prepare("INSERT INTO comment (text, id_user, id_tweet, creation_date) VALUES(?, ?, ?, NOW())");
        $stmt->bind_param('sii', $this->text, $this->id_user, $this->id_tweet);
        $this->text = htmlspecialchars($this->text, ENT_QUOTES, 'UTF-8');
        $stmt->execute();
        $stmt->close();
    }
    
    public function loadFromDB(){
        
    }


}