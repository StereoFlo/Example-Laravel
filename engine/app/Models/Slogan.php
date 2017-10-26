<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Slogan
 * @package RecycleArt\Models
 */
class Slogan extends Model
{
    const DEFAULT_SLOGAN_ID = 1;
    protected $table = 'slogan';

    /**
     * @var array
     */
    protected $fillable = ['content'];

    /**
     * @return array
     */
    public function getSlogan(): array
    {
        $getSlogan = $this->where('id', self::DEFAULT_SLOGAN_ID)->first();
        if (empty($getSlogan)) {
            return [];
        }
        return $getSlogan->toArray();
    }

    /**
     * @param string $content
     *
     * @return boolean
     */
    public function updateSlogan(string $content)
    {
        return $this->where('id', self::DEFAULT_SLOGAN_ID)->update(['content' => $content]);
    }
}
