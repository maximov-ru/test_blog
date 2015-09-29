<?php
namespace common\models\queries;
if(trait_exists('GenericQueries'))
    return;

trait GenericQueries {
    private static $idMap = [];

    /**
     * @param $pk
     * @return static
     */
    public static function qPk($pk) {
        $pk = strtolower($pk);
        if (!isset(self::$idMap[$pk])) {
            $element = self::findOne(['id'=>$pk]);

            self::$idMap[$pk] = $element;
            return self::$idMap[$pk];
        }
        return self::$idMap[$pk];
    }
}