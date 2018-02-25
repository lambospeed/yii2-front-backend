<?php
/**
 * Created by PhpStorm.
 * User: doo
 * Date: 11/30/16
 * Time: 12:04 AM
 */

namespace backend\components;

use Imagine\Image\Point;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\base\Exception;
use yii\imagine\Image;
use Imagine\Image\Box;

class FileUploadBehavior extends \yiidreamteam\upload\FileUploadBehavior
{
    /**
     * After save event.
     */
    public function afterSave()
    {
        if ($this->file instanceof UploadedFile) {
            $path = $this->getUploadedFilePath($this->attribute);

            FileHelper::createDirectory(pathinfo($path, PATHINFO_DIRNAME), 0775, true);
            if (!$this->file->saveAs($path)) {
                throw new Exception('File saving error.');
            }
            $photo = Image::getImagine()->open($path);

            $watermark = Image::getImagine()->open(\Yii::getAlias('@frontend') . '/web/images/wm.png');

            $bottomRight = new Point(100, 87);
            $photo->thumbnail(new Box(400, 300))->paste($watermark, $bottomRight)->save($path);
            $this->owner->trigger(static::EVENT_AFTER_FILE_SAVE);
        }
    }
}