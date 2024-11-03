<?php

namespace App\Policies;

use App\Models\Reduction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReductionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Reduction $reduction): bool
    {  return true;
    }

    public function create(User $user): bool
    {  return true;
    }

    public function update(User $user, Reduction $reduction): bool
    {  return true;
    }

    public function delete(User $user, Reduction $reduction): bool
    {  return true;
    }

    public function restore(User $user, Reduction $reduction): bool
    {  return true;
    }

    public function forceDelete(User $user, Reduction $reduction): bool
    {  return true;
    }
    public function attach(User $user, Reduction $reduction): bool
    {
        return true;
    }
}
