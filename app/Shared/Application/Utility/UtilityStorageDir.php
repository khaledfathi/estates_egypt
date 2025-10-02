<?php
declare (strict_types=1);
namespace App\Shared\Application\Utility;

use App\Shared\Application\Contracts\Storage\StorageDir;

class UtilityStorageDir implements StorageDir {
    public static function estateDocuments (int $estateId){
        return  "estaets/$estateId/documents/";
    }
    public static function estateUtilityServices(int $estateId){
        return  "estaets/$estateId/utility_services/";
    }
    public static function unitDocuments (int $estateId , int $unitId){
        return  "estaets/$estateId/units/$unitId.'/documents/";
    }
    public static function unitUtilityServices ($estateId , $unitId){
        return  "estaets/$estateId/units/'.$unitId.'/utility_service/";
    }
}