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
     * @return string
     */
    public function getSlogan(): string
    {
        $getSlogan = $this->where('id', self::DEFAULT_SLOGAN_ID)->first();
        if (empty($getSlogan)) {
            return '';
        }
        if (!isset($getSlogan['content'])) {
            return '';
        }
        return $getSlogan['content'];
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
