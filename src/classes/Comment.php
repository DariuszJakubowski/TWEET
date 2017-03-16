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
    
    public function getId_user() {
        return $this->id_user;
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
    
    //zwraca tablicę asocjacyjną, gdzie kluczami są id_tweet => [obiekty..]
    public function loadAllComments(mysqli $conn, $id_user) {
        $allComments = [];
        $result = $conn->query("SELECT * FROM comment WHERE id_tweet IN "
                . "(SELECT tweet.id FROM tweet WHERE id_user={$id_user}) "
                . "ORDER BY comment.id_tweet");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comment = new Comment;
                $comment->id = $row['id'];
                $comment->text = $row['text'];
                $comment->id_user = $row['id_user'];
                $comment->id_tweet = $row['id_tweet'];
                $comment->creation_date = $row['creation_date'];
                $allComments[$row['id_tweet']][] = $comment;
            }            
        }
        return $allComments;
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