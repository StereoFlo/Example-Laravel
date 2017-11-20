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
    protected function getAutor()
    {
        return App::make('RecycleArt\Models\Author');
    }

    /**
     * @return Catalog
     */
    protected function getCatalog()
    {
        return App::make('RecycleArt\Models\Catalog');
    }

    /**
     * @return CatalogRel
     */
    protected function getCatalogRelation()
    {
        return App::make('RecycleArt\Models\CatalogRel');
    }

    /**
     * @return Material
     */
    protected function getMaterial()
    {
        return App::make('RecycleArt\Models\Material');
    }

    /**
     * @return MaterialRel
     */
    protected function getMaterialRelation()
    {
        return App::make('RecycleArt\Models\MaterialRel');
    }

    /**
     * @return News
     */
    protected function getNews()
    {
        return App::make('RecycleArt\Models\News');
    }

    /**
     * @return Role
     */
    protected function getRole()
    {
        return App::make('RecycleArt\Models\Role');
    }

    /**
     * @return RoleUser
     */
    protected function getRoleRelation()
    {
        return App::make('RecycleArt\Models\RoleUser');
    }

    /**
     * @return TagsRel
     */
    protected function getTagsRelation()
    {
        return App::make('RecycleArt\Models\TagsRel');
    }

    /**
     * @return Work
     */
    protected function getWork()
    {
        return App::make('RecycleArt\Models\Work');
    }

    /**
     * @return WorkImages
     */
    protected function getWorkImages()
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
