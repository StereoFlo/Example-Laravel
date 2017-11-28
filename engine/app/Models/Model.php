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
    protected function getAuthor(): Author
    {
        return App::make('RecycleArt\Models\Author');
    }

    /**
     * @return Catalog
     */
    protected function getCatalog(): Catalog
    {
        return App::make('RecycleArt\Models\Catalog');
    }

    /**
     * @return CatalogRel
     */
    protected function getCatalogRelation(): CatalogRel
    {
        return App::make('RecycleArt\Models\CatalogRel');
    }

    /**
     * @return Material
     */
    protected function getMaterial(): Material
    {
        return App::make('RecycleArt\Models\Material');
    }

    /**
     * @return MaterialRel
     */
    protected function getMaterialRelation(): MaterialRel
    {
        return App::make('RecycleArt\Models\MaterialRel');
    }

    /**
     * @return News
     */
    protected function getNews(): News
    {
        return App::make('RecycleArt\Models\News');
    }

    /**
     * @return Role
     */
    protected function getRole(): Role
    {
        return App::make('RecycleArt\Models\Role');
    }

    /**
     * @return RoleUser
     */
    protected function getRoleRelation(): RoleUser
    {
        return App::make('RecycleArt\Models\RoleUser');
    }

    /**
     * @return TagsRel
     */
    protected function getTagsRelation(): TagsRel
    {
        return App::make('RecycleArt\Models\TagsRel');
    }

    /**
     * @return Work
     */
    protected function getWork(): Work
    {
        return App::make('RecycleArt\Models\Work');
    }

    /**
     * @return WorkImages
     */
    protected function getWorkImages(): WorkImages
    {
        return App::make('RecycleArt\Models\WorkImages');
    }

    /**
     * @param object|null $obj
     *
     * @return bool
     */
    protected function checkEmptyObject($obj = null): bool 
    {
        if (empty($obj)) {
            return false;
        }
        if (!\method_exists($obj, 'toArray')) {
            return false;
        }
        if (empty($obj->toArray())) {
            return false;
        }
        return true;
    }


}
