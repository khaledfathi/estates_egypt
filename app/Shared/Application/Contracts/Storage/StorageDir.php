<?php

declare (strict_types=1);
namespace App\Shared\Application\Contracts\Storage; 

interface StorageDir {
    public static function estateDocuments (int $estateId);
    public static function estateUtilityServices(int $estateId);
    public static function unitDocuments (int $estateId , int $unitId);
    public static function unitUtilityServices ($estateId , $unitId);
}