<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (auth()->guard('admin')->check()) {
            return true;
        }
    }

    /**
    * Determine whether the user can view the order.
    *
    * @param  \App\User  $user
    * @param  \App\Order  $order
    * @return mixed
    */
    public function view(User $user, Order $order)
    {
        //
    }

    /**
    * Determine whether the user can create orders.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function create(User $user)
    {
        //
    }

    /**
    * Determine whether the user can update the order.
    *
    * @param  \App\User  $user
    * @param  \App\Order  $order
    * @return mixed
    */
    public function update(User $user, Order $order)
    {
        if ($user->id == $order->user_id) {
            if($order->status == 'processing'){
                return false;
            }
            return true;
        }
        return false;
    }

    /**
    * Determine whether the user can delete the order.
    *
    * @param  \App\User  $user
    * @param  \App\Order  $order
    * @return mixed
    */
    public function delete(User $user, Order $order)
    {
        //
    }
}
