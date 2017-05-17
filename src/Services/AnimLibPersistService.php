<?php
/**
 * Created by PhpStorm.
 * User: ralphy
 * Date: 17/05/17
 * Time: 15:41
 */

namespace Services;

/**
 * Class AnimLibDataService
 * Persistance de la base de données Anime Library
 * @package Services
 */
class AnimLibPersistService
{
    const DATA_PATH = 'data';

    public function getShowList() {
        $aList = array();
        foreach (scandir(self::DATA_PATH) as $sDir) {
            if (substr($sDir, 0, 1) !== '.') {
                $aList[] = $sDir;
            }
        }
        return $aList;
    }

}