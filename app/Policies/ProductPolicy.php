<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create products.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param User $user
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param User $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->is_admin;
    }
}
