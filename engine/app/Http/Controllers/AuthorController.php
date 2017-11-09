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
     * @var User
     */
    private $user;

    /**
     * @var Work
     */
    private $work;

    /**
     * AuthorController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
        $this->work = new Work();
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $author = $this->user->getById($id);
        if (empty($author)) {
            abort(404);
        }

        return \view('author.show', [
            'author' => $this->user->getById($id),
            'works'  => $this->work->getListByUserWithImages($id),
        ]);
    }
}
