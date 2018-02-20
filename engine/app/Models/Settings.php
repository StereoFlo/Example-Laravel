<?php

namespace RecycleArt\Models;

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
     * @var self
     */
    protected static $allSettings;

    /**
     * get all settings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        if (empty(self::$allSettings)) {
            self::$allSettings = self::all();
        }
        return self::$allSettings;
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
        return $this->getFromArray($settingSlug, $allSettings);
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
            $settingArray = $this->getFromArray($settingSlug, $allSettings);
            if (!empty($settingArray) && $settingArray['setting_value'] !== $settingValue) {
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

    /**
     * @param string $settingSlug
     * @param $allSettings
     * @return array
     */
    protected function getFromArray(string $settingSlug, array $allSettings): array
    {
        foreach ($allSettings as $val) {
            if ($val['setting_slug'] === $settingSlug) {
                return $val;
            }
        }
        return [];
    }
}
