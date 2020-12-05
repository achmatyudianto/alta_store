<?php

namespace App\Policies;

use App\User;
use App\Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Cart $cart)
    {
        return $user->ownsCart($cart);
    }

    public function update(User $user, Cart $cart)
    {
        return $user->ownsCart($cart);
    }
}
