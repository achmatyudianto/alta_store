<?php

namespace App\Policies;

use App\User;
use App\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function payment(User $user, Transaction $transaction)
    {
        return $user->ownsTransaction($transaction);
    }
}
