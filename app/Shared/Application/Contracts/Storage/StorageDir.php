<?php

declare (strict_types=1);
namespace App\Shared\Application\Contracts\Storage; 

interface StorageDir {
    public function privatePath():StorageDir;
    public function publicPath():StorageDir;
    public function estateDocuments (int $estateId):string;
    public function estateUtilityServices(int $estateId):string;
    public function unitDocuments (int $estateId , int $unitId):string;
    public function unitUtilityServices ($estateId , $unitId):string;
}