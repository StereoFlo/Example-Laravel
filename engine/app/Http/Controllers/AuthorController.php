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
     *
     * @param User $user
     * @param Work $work
     */
    public function __construct(User $user, Work $work)
    {
        $this->user = $user;
        $this->work = $work;
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
            'author' => $author,
            'works'  => $this->work->getListByUserWithImages($id),
        ]);
    }
}
