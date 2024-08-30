<?php

namespace App\Policies;

use App\Models\DomainRule;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DomainRulePolicy
{
    use HandlesAuthorization;

    public function view(User $user, DomainRule $domainRule)
    {
        return $user->id === $domainRule->user_id;
    }

    public function update(User $user, DomainRule $domainRule)
    {
        return $user->id === $domainRule->user_id;
    }

    public function delete(User $user, DomainRule $domainRule)
    {
        return $user->id === $domainRule->user_id;
    }
}
