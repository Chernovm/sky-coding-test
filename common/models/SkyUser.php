<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * SkyUser model
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $patronymic 
 * @property string $email;
 * @property string $legal_body;
 * @property string $private_enterpreneur;
 * @property string $tax_number;
 * @property string $company_name;
 */

class SkyUser extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sky_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getFullName()
    {
        return "$this->firstname $this->lastname $this->patronymic";
    }
}
