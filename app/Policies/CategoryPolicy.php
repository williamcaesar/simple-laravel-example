<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param User $user
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param User $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->is_admin;
    }
}
