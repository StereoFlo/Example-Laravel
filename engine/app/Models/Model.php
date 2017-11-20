<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model as EModel;
use Illuminate\Support\Facades\App;

/**
 * Class Model
 * @package RecycleArt\Models
 */
class Model extends EModel
{
    /**
     * @return Author
     */
    public function getAutor()
    {
        return App::make('RecycleArt\Models\Author');
    }

    /**
     * @return Catalog
     */
    public function getCatalog()
    {
        return App::make('RecycleArt\Models\Catalog');
    }

    /**
     * @return CatalogRel
     */
    public function getCatalogRelation()
    {
        return App::make('RecycleArt\Models\CatalogRel');
    }

    /**
     * @return Material
     */
    public function getMaterial()
    {
        return App::make('RecycleArt\Models\Material');
    }

    /**
     * @return MaterialRel
     */
    public function getMaterialRelation()
    {
        return App::make('RecycleArt\Models\MaterialRel');
    }

    /**
     * @return News
     */
    public function getNews()
    {
        return App::make('RecycleArt\Models\News');
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return App::make('RecycleArt\Models\Role');
    }

    /**
     * @return RoleUser
     */
    public function getRoleRelation()
    {
        return App::make('RecycleArt\Models\RoleUser');
    }

    /**
     * @return TagsRel
     */
    public function getTagsRelation()
    {
        return App::make('RecycleArt\Models\TagsRel');
    }

    /**
     * @return Work
     */
    public function getWork()
    {
        return App::make('RecycleArt\Models\Work');
    }

    /**
     * @return WorkImages
     */
    public function getWorkImages()
    {
        return App::make('RecycleArt\Models\WorkImages');
    }

    /**
     * @param object|null $obj
     *
     * @return bool
     */
    protected function checkEmptyObject($obj = null)
    {
        if (empty($obj)) {
            return false;
        }
        if (!method_exists($obj, 'toArray')) {
            return false;
        }
        if (empty($obj->toArray())) {
            return false;
        }
        return true;
    }


}
