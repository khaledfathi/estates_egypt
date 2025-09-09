<?php
declare(strict_types= 1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\SettingEntity;

interface SettingRepository {
    public function getByName(string $key): SettingEntity;
    public function store(SettingEntity $settingEntity): SettingEntity;
    public function destroy(int $id): bool;
}