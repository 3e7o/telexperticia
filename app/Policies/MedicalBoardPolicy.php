<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MedicalBoard;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicalBoardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the medicalBoard can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list medicalboards');
    }

    /**
     * Determine whether the medicalBoard can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalBoard  $model
     * @return mixed
     */
    public function view(User $user, MedicalBoard $model)
    {
        return $user->hasPermissionTo('view medicalboards');
    }

    /**
     * Determine whether the medicalBoard can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create medicalboards');
    }

    /**
     * Determine whether the medicalBoard can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalBoard  $model
     * @return mixed
     */
    public function update(User $user, MedicalBoard $model)
    {
        return $user->hasPermissionTo('update medicalboards');
    }

    /**
     * Determine whether the medicalBoard can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalBoard  $model
     * @return mixed
     */
    public function delete(User $user, MedicalBoard $model)
    {
        return $user->hasPermissionTo('delete medicalboards');
    }

    /**
     * Determine whether the medicalBoard can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalBoard  $model
     * @return mixed
     */
    public function restore(User $user, MedicalBoard $model)
    {
        return false;
    }

    /**
     * Determine whether the medicalBoard can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalBoard  $model
     * @return mixed
     */
    public function forceDelete(User $user, MedicalBoard $model)
    {
        return false;
    }
}
