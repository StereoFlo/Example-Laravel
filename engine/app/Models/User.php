<?php

namespace RecycleArt\Models;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * test
     */
    const ROLE_ADMIN     = 'admin';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_AUTHOR    = 'author';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
        'phone',
        'about',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected $currentUser;

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        return new self();
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     *
     * @return self
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return self
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbout(): string
    {
        return $this->about;
    }

    /**
     * @param string $about
     *
     * @return self
     */
    public function setAbout(string $about): self
    {
        $this->about = $about;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     *
     * @return self
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this
            ->belongsToMany('RecycleArt\Models\Role')
            ->withTimestamps();
    }

    /**
     * @param $roles
     *
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
        return false; //stub
    }


    /**
     * @param array|string $roles
     *
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
            return false;
        }
        if ($this->hasRole($roles)) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isModerator()
    {
        return $this->hasAnyRole([self::ROLE_ADMIN, self::ROLE_MODERATOR]);
    }

    /**
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return self::All();
    }

    /**
     * get user by id
     *
     * @param int $id
     *
     * @return array
     */
    public function getById(int $id): array
    {
        $user = self::find($id);
        if (empty($user) || empty($user->toArray())) {
            return [];
        }
        return $user->toArray();
    }

    /**
     * create a new user
     *
     * @param array $data
     * @return self
     */
    public function createUser(array $data)
    {
        return self::create([
            'name'     => $data['name'],
            //'location' => $data['location'],
            //'phone'    => $data['phone'],
            'vkId'     => $data['vkId'],
            'email'    => $data['email'],
            'password' => \bcrypt($data['password']),
        ]);
    }

    /**
     * @return bool
     */
    public function removeAvatar(): bool
    {
        $currentUser = Auth::user();
        $avatar = $currentUser->avatar;
        $currentUser->avatar = null;
        $isSaved = $currentUser->save();
        if (!empty($avatar) && $isSaved) {
            $path = \public_path($avatar);
            $isSaved = File::delete($path);
        }
        return $isSaved;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updateProfile(Request $request)
    {
        $user           = Auth::user();
        $user->name     = $request->post('name');
        $user->email    = $request->post('email');
        $user->location = $request->post('location');
        $user->phone    = $request->post('phone');
        $user->about    = $request->post('about');

        $this->uploadAvatar($request->file('avatar'), $user);
        $this->setPassword($request, $user);

        return $user->save();
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function removeUser(int $id): bool
    {
        $user = self::findOrFail($id);
        return $this->where('id', $user->id)->delete() && Model::getModel()->getRoleRelation()->disableAllRole($user->id);

    }

    /**
     * @param UploadedFile|null $avatar
     * @param                   $user
     *
     * @return $this
     */
    private function uploadAvatar(UploadedFile $avatar = null, $user)
    {
        if (empty($avatar)) {
            return $this;
        }

        $avatar->move(\public_path('uploads/' . Auth::id()), 'avatar.' . $avatar->clientExtension());
        $user->avatar = '/uploads/' . Auth::id() . '/avatar.' . $avatar->clientExtension();
        return $this;
    }

    /**
     * @param Request $request
     * @param         $user
     *
     * @return $this
     */
    private function setPassword(Request $request, $user)
    {
        if (empty($request->post('password'))) {
            return $this;
        }
        if ($request->post('password') === $request->post('password_confirmation')) {
            $user->password = \bcrypt($request->input('password'));
        }
        return $this;
    }
}
