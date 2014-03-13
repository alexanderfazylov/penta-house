<?php

class User extends CActiveRecord {

    public $password_repeat;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{user}}';
    }

    public function rules() {
        return array(
            array('username, password, password_repeat', 'required'),
            array('username', 'unique'),
            array('username', 'email'),
            array('username, banned, laste_enter', 'length', 'max' => 128),
            array('profile', 'safe'),
            array('password_repeat', 'required', 'on' => 'register'),
            array('password password_repeat', 'compare', 'compareAttribute' => 'password'),
        );
    }

    public function relations() {
        return array(
            'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
            'prof' => array(self::HAS_ONE, 'Profile', 'user_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'Id',
            'password_repeat' => 'Пароль',
            'password' => 'Пароль',
            'username' => 'Эл. почта',
            'profile' => 'Profile',
            'banned' => 'banned',
            'verifyCode' => '',
            'laste_enter' => 'laste_enter'
        );
    }

    public function validatePassword($password) {
        //return $this->hashPassword($password,$this->salt)===$this->password;
        return $password === $this->password;
    }



}