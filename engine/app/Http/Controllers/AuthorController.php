<?php

namespace RecycleArt\Http\Controllers;

use RecycleArt\Models\User;
use RecycleArt\Models\Work;

/**
 * Class AuthorController
 * @package RecycleArt\Http\Controllers
 */
class AuthorController extends Controller
{
    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $author = User::getInstance()->getById($id);
        $works = Work::getInstance()->getListByUserWithImages($id);
        if (empty($author)) {
            abort(404);
        }

        return \view('author.show', ['author' => $author, 'works' => $works]);
    }
}
