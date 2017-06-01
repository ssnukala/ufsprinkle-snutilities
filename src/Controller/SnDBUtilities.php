<?php

/**
 * UserFrosting (http://www.srinivasnukala.com)
 * @link      https://github.com/ssnukala/ufsprinkle-snutilities
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 * */

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
        $var_dbcols = InfoSchemaColumns::getFieldDefinitions($table, $config['db.default.database']);
        SnUtil::logarr($var_dbcols, "Line 33");
    }

    public static function getTableDataArray($table, $where = '') {
        $var_colquery = " SELECT *  FROM $table";
        if ($where != '') {
            $var_colquery .= " WHERE $where";
        }
        $var_dbcols = Capsule::select($var_colquery);
        return $var_dbcols;
    }

}
