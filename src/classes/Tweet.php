<?php

class Tweet
{
    private $id;
    private $id_user;
    private $text;


    function __construct()
    {
        $this->id = -1;
        $this->id_user = -1;
        $this->text = '';
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
    
    public function addText(mysqli $conn, $id_user, $post) {
        
        $sql = "INSERT INTO tweet(id_user, text) VALUES( ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is', $this->id_user, $this->text);
        $this->id_user = $id_user;
        // xss filtering function
        $this->text = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
       
        $stmt->execute();
        $conn = DataBase::disconnect();
       
        return TRUE;
    }
    
    public function getAllMyTweets(mysqli $conn, $connected_user) {
        $myTweets = [];
        $sql = "SELECT tweet.text AS tweet, user.email AS user FROM tweet INNER JOIN user ON tweet.id_user=user.id WHERE id_user=$connected_user";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $myTweets[] = ['my_email' => $row['user'], 'my_text' => $row['tweet']];
            }
            return $myTweets;
        } else {
            return FALSE;
        }
    }
}