<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\SettingEntity;
use App\Shared\Domain\Repositories\SettingRepository;
use App\Shared\Infrastructure\Models\Setting\Setting;

final class EloquentSettingRepository implements SettingRepository
{

    public function getByName(string $name): SettingEntity
    {
        $record = Setting::where("name", $name)->first();
        return new SettingEntity(
            $record->id,
            $record->name,
            $record->value,
        );
    }
    public function store(SettingEntity $settingEntity): SettingEntity
    {
        $record = Setting::create([
            "name" => $settingEntity->name,
            "value" => $settingEntity->value
        ]);
        $settingEntity->id = $record->id;
        return $settingEntity;
    }
    public function destroy(int $id): bool
    {
        return setting::findorfail($id)->delete();
    }
}
