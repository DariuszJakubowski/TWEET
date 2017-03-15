<?php

class Tweet
{
    private $id;
    private $id_user;
    private $text;

    public function __construct() {
        $this->id = -1;
        $this->id_user = -1;
        $this->text = '';
    }

    public function getId() {
        return $this->id;
    }
    public function getId_user() {
        return $this->id_user;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function addText(mysqli $conn, $text, $id_user) {
        
        $stmt = $conn->prepare("INSERT INTO tweet(id_user, text) "
                . "VALUES( ?, ?)");
        $stmt->bind_param('is', $this->id_user, $this->text);
        $this->id_user = $id_user;
        // xss filtering function
        $this->text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $stmt->execute();
        $stmt->close();
       
        return true;
    }
    
    public function loadTweet(mysqli $conn, $id) {
        $result = $conn->query("SELECT * FROM tweet WHERE id={$id}");
        if($result->num_rows > 0) {
            $tweet = new Tweet();
            while ($row = $result->fetch_assoc()) {              
                $tweet->id = $id;
                $tweet->id_user = $row['id_user'];
                $tweet->text = $row['text'];
            }
            return $tweet;
        } else {
            return false;
        }
    }

    public function loadAllTweets(mysqli $conn, $id_user) {
        $tweets = [];
        $sql = "SELECT tweet.id AS id_tweet,"
                . "tweet.id_user AS id_user,"
                . "tweet.text AS tweet,"
                . " user.email AS user "
                . "FROM tweet INNER JOIN user ON tweet.id_user=user.id "
                . "WHERE id_user = {$id_user}";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tweets[] = [
                               'id_tweet' => $row['id_tweet'],
                               'id_user' => $row['id_user'],
                               'email' => $row['user'],
                               'tweet' => $row['tweet']
                              ];
            }
            return $tweets;
        } 
    }
    
    public function updateTweet(mysqli $conn, $text, $id_user) {
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        if($conn->query("UPDATE tweet "
                . "SET text='{$text}' "
                . "WHERE id={$this->id} AND id_user={$id_user}")) {
            return true;
        }      
    }
    
    public function deleteTweet(mysqli $conn, $id, $id_user) {
        //check if tweet belong to loged user
        if($conn->query("DELETE FROM tweet "
                . "WHERE id={$id} AND id_user={$id_user}")){
            return true;
        }  
    }
}
