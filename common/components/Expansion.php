<?php

namespace common\components;

use common\models;
use dpodium\yii2\geoip\components\GeoIP;
use Yii;
use yii\base\Component;

/**
 * Class Expansion
 * @package common\components
 */
class Expansion extends Component
{
    const SUFFIX_DELIMITTER = "_";

    protected $forceExpansion = null;

    /**
     * @param integer $value
     */
    public function setForceExpansion($value)
    {
        $this->forceExpansion = $value;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        if (empty($this->forceExpansion)) {
            $currentCode = $this->getCurrentCountryCode();
            $expansionId = $this->getExpansionIdByCode($currentCode);
        } else {
            $expansionId = $this->forceExpansion;
        }

        /** @var models\Expansion $expansion */
        $expansion = models\Expansion::find()->andFilterWhere(['id' => $expansionId])->one();

        if ( ! empty($expansion)) {
            return $expansion->code;
        }

        // TODO it is error, default Expansion must be existed
        return '';
    }

    /**
     * @return integer
     */
    public function getForceExpansion()
    {
        return $this->forceExpansion;
    }

    /**
     * @return string
     */
    public function getTableSuffix()
    {
        if (!empty($this->forceExpansion)) {
            return static::SUFFIX_DELIMITTER . $this->forceExpansion;
        }

        $currentCode = $this->getCurrentCountryCode();
        $expansionId = $this->getExpansionIdByCode($currentCode);

        if (!empty($expansionId)) {
            return static::SUFFIX_DELIMITTER . $expansionId;
        }

        // TODO it is error, default Expansion must be existed
        return '';
    }

    /**
     * @return string
     */
    public function getUserIp()
    {
        if ( ! empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            return $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        if ( ! empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }

        return Yii::$app->request->getUserIP();
    }

    /**
     * @return string
     */
    public function getCurrentCountryCode()
    {
        /** @var GeoIP $geoIp */
        $geoIp = Yii::$app->get('geoip');

        return $geoIp->lookupCountryCode($this->getUserIP());
    }

    /**
     * @param string $code
     * @return integer
     */
    public function getExpansionIdByCode($code)
    {
        /** @var models\Expansion $expansion */
        $expansion = models\Expansion::find()
            ->andFilterWhere(
                [
                    'like',
                    'countries',
                    $code
                ]
            )
            ->one();

        if (!empty($expansion)) {
            return $expansion->id;
        }

        /** @var models\Expansion $expansion */
        $expansion = models\Expansion::find()->andFilterWhere(['default' => 1])->one();

        if (!empty($expansion)) {
            return $expansion->id;
        }

        // TODO it is error, default Expansion must be existed
        return 0;
    }

    /**
     * @return bool
     */
    public function isNeededCookiesLaw()
    {
        if (empty($this->forceExpansion)) {
            $currentCode = $this->getCurrentCountryCode();
            $expansionId = $this->getExpansionIdByCode($currentCode);
        } else {
            $expansionId = $this->forceExpansion;
        }

        /** @var models\Expansion $expansion */
        $expansion = models\Expansion::find()->andFilterWhere(['id' => $expansionId])->one();

        if ( ! empty($expansion)) {
            return $expansion->need_cookies_law;
        }

        // TODO it is error, default Expansion must be existed
        return false;
    }
}
