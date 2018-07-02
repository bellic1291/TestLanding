<?php

namespace frontend\models;

use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends \yii\db\ActiveRecord
{
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required', 'message' => 'Это обязательное поле'],
            [['description', 'phone'], 'string'],
            ['email', 'email', 'message' => 'Это не электронная почта'],
            ['verifyCode', 'captcha', 'message' => 'Вы ввели неправильные символы с картинки'],
        ];
    }
    
    public static function tableName()
    {
        return 'request';
    }
    
    public function beforeValidate()
    {
        if (empty($this->email) && empty($this->phone))
        {
            $this->addError('email');
            $this->addError('phone', 'Одно из полей должно быть заполнено');
            return false;            
        }
        return true;        
    }
    
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'address' => 'Адрес',
            'email' => 'Эл. почта',
            'phone' => 'Телефон',
            'description' => 'Комментарий',
            'verifyCode' => 'Введите символы',
        ];
    }
    

    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
