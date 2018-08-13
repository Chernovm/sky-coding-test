<?php
namespace frontend\models;

use yii\base\Model;
use common\models\SkyUser;

/**
 * Registration form
 */
class RegistrationForm extends Model
{
    public $firstname;
    public $lastname;
    public $patronymic;
    public $email;
    public $legal_body;
    public $private_enterpreneur;
    public $tax_number;
    public $company_name;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['firstname', 'trim'],
            ['firstname', 'required'],            
            ['firstname', 'string', 'min' => 2, 'max' => 255],
            ['lastname', 'trim'],
            ['lastname', 'required'],            
            ['lastname', 'string', 'min' => 2, 'max' => 255],
            ['patronymic', 'trim'],
            ['patronymic', 'required'],            
            ['patronymic', 'string', 'min' => 2, 'max' => 255],
            // Full name is a combination of first name, last name and patronymic
            // should be unique
            [
                ['firstname'], 'unique', 'targetAttribute' => ['firstname', 'lastname', 'patronymic'], 
                'targetClass' => '\common\models\SkyUser', 'message' => 'This full name has already been taken.'
            ],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\SkyUser', 'message' => 'This email address has already been taken.'],

            ['legal_body', 'boolean'],
            ['legal_body', 'required'],
            ['private_enterpreneur', 'boolean'],
            ['private_enterpreneur', 'required'],

            ['tax_number', 'string', 'max' => 255],
            // Create inline validator for tax_number: based on provided requirements
            // This field should be required for legal_body users and individual enterpreneurs
            [
                'tax_number', function ($attribute, $params, $validator) {
                    if ($this->isLegalBody() && empty($this->$attribute)) {
                        $this->addError($attribute, 'Tax number is required for legal body user');
                    }

                    if ($this->isEnterpreneur() && empty($this->$attribute)) {
                        $this->addError($attribute, 'Tax number is required for private enterpreneur user');
                    }
                }, 
                'skipOnEmpty' => false
            ],
            ['company_name', 'string', 'max' => 255],
            // Create inline validator for company name: based on provided requirements
            // This field should be required for legal_body users
            [
                'company_name', function ($attribute, $params, $validator) {
                    if ($this->isLegalBody() && empty($this->$attribute)) {
                        $this->addError($attribute, 'Company name is required for legal body user');
                    }
                }, 
                'skipOnEmpty' => false
            ]
        ];
    }

    /**
     * Registers new user in system.
     *
     * @return SkyUser|null the saved model or null if saving fails
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        \Yii::error(print_r($this, true));
        
        $user = new SkyUser();
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->patronymic = $this->patronymic;
        $user->email = $this->email;

        $user->legal_body = $this->legal_body;
        $user->private_enterpreneur = $this->private_enterpreneur;

        $user->tax_number = $this->tax_number;
        $user->company_name = $this->company_name;
        
        return $user->save() ? $user : null;
    }

    public function isLegalBody()
    {
        return ($this->legal_body == true);
    }

    public function isEnterpreneur()
    {
        return ($this->private_enterpreneur == true);
    }
}
