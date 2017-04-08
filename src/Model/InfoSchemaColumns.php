<?php

/**
 * UserFrosting (http://www.srinivasnukala.com)
 * @link      https://github.com/ssnukala/ufsprinkle-sndbforms
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 **/


namespace UserFrosting\Sprinkle\SnUtilities\Model;
use \Illuminate\Database\Capsule\Manager as Capsule; 
use UserFrosting\Sprinkle\Core\Model\UFModel;


/**
 * UserFrosting (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/UserFrosting
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 * @license   https://github.com/userfrosting/UserFrosting/blob/master/licenses/UserFrosting.md (MIT License)
 */

class InfoSchemaColumns extends UFModel
 {
//    protected $table = "adm_formfields";

//    protected $fillable = [];


//DELIMITER ;;
//CREATE PROCEDURE `createMigrationDefs`(IN par_schema VARCHAR(50),IN par_tablename VARCHAR(255))
//BEGIN 
//SELECT 
// concat("$table->" COLLATE utf8_unicode_ci, 
// CASE DATA_TYPE WHEN 'varchar'  COLLATE utf8_unicode_ci THEN 'string'  COLLATE utf8_unicode_ci  WHEN 'tinyint'  COLLATE utf8_unicode_ci THEN 'integer'  COLLATE utf8_unicode_ci 
// WHEN 'int'  COLLATE utf8_unicode_ci THEN 'integer'  COLLATE utf8_unicode_ci WHEN 'datetime'  COLLATE utf8_unicode_ci THEN 'dateTime'  COLLATE utf8_unicode_ci ELSE DATA_TYPE END,"('" COLLATE utf8_unicode_ci ,COLUMN_NAME,"'" COLLATE utf8_unicode_ci,
//CASE CHARACTER_MAXIMUM_LENGTH IS NOT NULL  WHEN TRUE  THEN concat("," COLLATE utf8_unicode_ci, CHARACTER_MAXIMUM_LENGTH) ELSE '' END, 
//CASE NUMERIC_PRECISION IS NOT NULL  WHEN TRUE  THEN concat("," COLLATE utf8_unicode_ci, NUMERIC_PRECISION)  ELSE '' END ,
//CASE NUMERIC_SCALE IS NOT NULL  WHEN TRUE  THEN concat(',' COLLATE utf8_unicode_ci,NUMERIC_SCALE) ELSE ''  COLLATE utf8_unicode_ci END,')'  COLLATE utf8_unicode_ci,
//CASE IS_NULLABLE ='YES' WHEN TRUE THEN '->nullable()'  COLLATE utf8_unicode_ci ELSE ''  COLLATE utf8_unicode_ci END,
//CASE COLUMN_DEFAULT IS NOT NULL AND COLUMN_DEFAULT !='' WHEN TRUE THEN concat("->default(", CASE DATA_TYPE IN ('int','tinyint')  WHEN FALSE THEN concat("'" COLLATE utf8_unicode_ci,COLUMN_DEFAULT, "'" COLLATE utf8_unicode_ci )  ELSE COLUMN_DEFAULT  END,")" COLLATE utf8_unicode_ci) ELSE ''  COLLATE utf8_unicode_ci END, ';'  COLLATE utf8_unicode_ci  
//  )
//    FROM information_schema.COLUMNS c 
//    WHERE TABLE_NAME COLLATE utf8_unicode_ci  =par_tablename COLLATE utf8_unicode_ci  AND table_schema COLLATE utf8_unicode_ci  = par_schema COLLATE utf8_unicode_ci 
//    AND COLUMN_NAME COLLATE utf8_unicode_ci  NOT IN (SELECT db_name COLLATE utf8_unicode_ci  FROM crsvk_adm_formfields WHERE TABLE_NAME COLLATE utf8_unicode_ci  = c.table_name COLLATE utf8_unicode_ci) ;
//END;;
//DELIMITER ;


    public static function getFieldDefinitions($table,$pardb) {
        $var_colquery = " SELECT *  FROM information_schema.COLUMNS c 
    WHERE TABLE_NAME  ='$table' AND table_schema  = '$pardb' ";
        
        $var_dbcols = Capsule::select($var_colquery); 
        return $var_dbcols;
    }

    
}