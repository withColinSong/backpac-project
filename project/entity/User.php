<?php

namespace entity;

class User
{

    private $name;          // 이름
    private $nickname;      // 별명
    private $password;      // 비밀번호
    private $phone;         // 전화번호
    private $email;         // 이름
    private $gender;        // 성별

    /**
     * @param $name
     * @param $nickname
     * @param $password
     * @param $phone
     * @param $email
     */
    private function __construct($name, $nickname, $password, $phone, $email, $gender)
    {
        $this->name = $name;
        $this->nickname = $nickname;
        $this->password = $password;
        $this->phone = $phone;
        $this->email = $email;
        $this->gender = $gender;
    }

    public static function of($array)
    {
        $name = $array['NAME'];
        $nickname = $array['NICKNAME'];
        $password = $array['PASSWORD'];
        $phone = $array['PHONE'];
        $email = $array['EMAIL'];
        $gender = $array['GENDER'];

        return new User($name, $nickname, $password, $phone, $email, $gender);
    }


    ////////////////
    /// getter
    ///////////////


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }


}