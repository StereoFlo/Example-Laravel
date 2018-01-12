<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * the table name
     * @var string
     */
    protected $table = 'settings';

    protected $fillable = [
        'setting_value',
        'setting_data',
    ];

    /**
     * get all settings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return self::all();
    }

    /**
     * @param string $settingSlug
     * @return array
     */
    public function getOneFromArray(string $settingSlug): array
    {
        $allSettings = $this->getAllArray();
        if (empty($allSettings)) {
            return [];
        }

        foreach ($allSettings as $val) {
            if ($val['setting_slug'] === $settingSlug) {
                return $val;
            }
        }
        return [];
    }

    /**
     * @return array
     */
    public function getAllArray()
    {
        return $this->getAll()->toArray();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        if (empty($data)) {
            return false;
        }
        $isSaved = false;
        $allSettings = $this->getAllArray();
        foreach ($data as $settingSlug => $settingValue) {
            if (isset($allSettings[$settingSlug]) && $allSettings[$settingSlug] !== $settingValue) {
                $isSaved = $this->updateSetting($settingSlug, $settingValue);
            }
        }
        return $isSaved;
    }

    /**
     * @param $settingSlug
     * @param $settingValue
     *
     * @return bool
     */
    protected function updateSetting($settingSlug, $settingValue): bool
    {
        $setting = new self();
        return $setting->where('setting_slug', $settingSlug)->update(['setting_value' => $settingValue]);
    }
}
