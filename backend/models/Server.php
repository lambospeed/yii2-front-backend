<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * Class Server
 * @package backend\models
 *
 * This is the model class for table "{{%server}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $user
 * @property string $host
 * @property string $path
 * @property string $state
 */
class Server extends ActiveRecord
{
    const STATE_SYNCED = 'synced';
    const STATE_NEED_SYNC = 'need sync';
    const STATE_IN_PROGRESS = 'in progress';
    const STATE_SYNC_FAILED = 'sync failed';

    public static function tableName()
    {
        return '{{%server}}';
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'user',
                    'host',
                    'path',
                ],
                'required'
            ],
            [
                [
                    'title',
                    'user',
                    'host',
                    'path',
                ],
                'filter',
                'filter' => 'trim'
            ],
            [
                [
                    'title',
                    'user',
                    'host',
                    'path',
                    'state',
                ],
                'string',
                'max' => 255
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'user' => 'User',
            'host' => 'Host',
            'path' => 'Path',
            'state' => 'State',
        ];
    }
}
