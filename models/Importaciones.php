<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "r10_importaciones".
 *
 * @property integer $r10_id
 * @property integer $r10_tipo
 * @property string $r10_url
 * @property integer $r10_usuAlta
 * @property string $r10_fecAlta
 */
class Importaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r10_importaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r10_tipo', 'r10_usuAlta'], 'integer'],
            [['r10_url'], 'required'],
            [['r10_fecAlta'], 'safe'],
            //[['r10_url'], 'string', 'max' => 200],
            //[['r10_url'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'r10_id' => 'R10 ID',
            'r10_tipo' => 'Tipo de importación',
            'r10_url' => 'Archivo',
            'r10_usuAlta' => 'Usuario Alta',
            'r10_fecAlta' => 'Fecha de realización',
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $this->r10_url->saveAs('upgrade/' . $this->r10_url->baseName . '.' . $this->r10_url->extension);
            return true;
        } else {
            return false;
        }
    }
}
