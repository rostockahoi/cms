<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\debug;

use Craft;
use yii\web\IdentityInterface;

/**
 * Debugger panel that collects and displays user info..
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class UserPanel extends \yii\debug\panels\UserPanel
{
    /**
     * @inheritdoc
     */
    protected function identityData(IdentityInterface $identity)
    {
        list($data, $attributes) = parent::identityData($identity);

        // Redact any sensitive attributes
        $security = Craft::$app->getSecurity();
        foreach ($data as $key => $value) {
            $data[$key] = $security->redactIfSensitive($key, $value);
        }

        return [$data, $attributes];
    }
}
