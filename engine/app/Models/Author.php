<?php

namespace RecycleArt\Models;

/**
 * Class Author
 * @package RecycleArt\Models
 */
class Author extends Model
{
    /**
     * @var User
     */
    private $user;

    /**
     * @return Author
     */
    public static function getInstance(): self
    {
        return new self();
    }

    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->user = new User();
        parent::__construct();
    }

    /**
     * Get the authors
     *
     * @return array
     */
    public function getList()
    {
        $authors = $this->from('role_user')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.name', User::ROLE_AUTHOR)
            ->get();
        if (!$this->checkEmptyObject($authors)) {
            return [];
        }
        return $authors->toArray();
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getByid(int $id): array
    {
        $res = self::find($id);
        if (!$this->checkEmptyObject($res)) {
            return [];
        }
        return $res->toArray();
    }
}
