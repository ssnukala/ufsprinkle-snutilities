<?php

/**
 * Chinmaya Registration Sevak (http://www.chinmayacloud.com)
 *
 * @link      https://github.com/chinmaya.regsevak
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 * @license   https://github.com/chinmaya.regsevak/blob/master/licenses/UserFrosting.md (MIT License)
 */

namespace UserFrosting\Sprinkle\SnUtilities\Controller;

use Carbon\Carbon;
use UserFrosting\Sprinkle\Core\Controller\SimpleController;
use UserFrosting\Support\Exception\ForbiddenException;
use UserFrosting\Sprinkle\Core\Util\EnvironmentInfo;
use UserFrosting\Sprinkle\SnUtilities\Model\InfoSchemaColumns;
use UserFrosting\Sprinkle\SnUtilities\Controller\SnUtilities as SnUtil;
/**
 * CDFormfieldsController
 *
 * An abstract controller class for connecting to iList2 providers.
 *
 * @package UserFrosting-OpenAuthentication
 * @author Srinivas Nukala
 * @link http://srinivasnukala.com
 */
class SnDBUtilities extends SimpleController {    
    public static function migrationsFromDB($table) {
        $config = $this->ci->config;
        $var_dbcols=InfoSchemaColumns::getFieldDefinitions($table,$config['db.default.database']);
SnUtil::logarr($var_dbcols,"Line 33");        
    }

}
