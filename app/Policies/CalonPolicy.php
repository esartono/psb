<?php

namespace App\Policies;

use App\User;
use App\Calon;
use Illuminate\Auth\Access\HandlesAuthorization;

class CalonPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any calons.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->level !== 2;
    }

    /**
     * Determine whether the user can view the calon.
     *
     * @param  \App\User  $user
     * @param  \App\Calon  $calon
     * @return mixed
     */
    public function view(User $user, Calon $calon)
    {
        return $user->id === $calon->user_id;
    }

    /**
     * Determine whether the user can create calons.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //return $user->id === $calon->user_id;
    }

    /**
     * Determine whether the user can update the calon.
     *
     * @param  \App\User  $user
     * @param  \App\Calon  $calon
     * @return mixed
     */
    public function update(User $user, Calon $calon)
    {
        return $user->id === $calon->user_id;
    }

    /**
     * Determine whether the user can delete the calon.
     *
     * @param  \App\User  $user
     * @param  \App\Calon  $calon
     * @return mixed
     */
    public function delete(User $user, Calon $calon)
    {
        return $user->id === $calon->user_id;
    }

    /**
     * Determine whether the user can restore the calon.
     *
     * @param  \App\User  $user
     * @param  \App\Calon  $calon
     * @return mixed
     */
    public function restore(User $user, Calon $calon)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the calon.
     *
     * @param  \App\User  $user
     * @param  \App\Calon  $calon
     * @return mixed
     */
    public function forceDelete(User $user, Calon $calon)
    {
        //
    }
}
