<?php

namespace App\Policies;

use App\Models\Devis;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DevisPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Devis $devis): bool
    {
        return true;
    }

    public function create(User $user): bool
    {  return true;
    }

    public function update(User $user, Devis $devis): bool
    {  return true;
    }

    public function delete(User $user, Devis $devis): bool
    {  return true;
    }

    public function restore(User $user, Devis $devis): bool
    {  return true;
    }

    public function forceDelete(User $user, Devis $devis): bool
    {  return true;
    }
}
