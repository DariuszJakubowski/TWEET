<?php
/**
 * Created by PhpStorm.
 * User: Darek
 * Date: 2016-09-15
 * Time: 13:24
 */

class Tweet
{
    private $id;
    private $user_email;
    private $text;


    function __construct()
    {
        $this->id = -1;
        $this->user_email;
        $this->text;
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
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
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

}