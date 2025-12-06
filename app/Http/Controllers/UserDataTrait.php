<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

trait UserDataTrait
{
    /**
     * Get authenticated user data for form auto-fill
     * 
     * @return array
     */
    protected function getUserData()
    {
        $user = Auth::user();

        if (!$user) {
            return [
                'name' => '',
                'email' => '',
                'phone' => '',
                'username' => '',
            ];
        }

        return [
            'name' => $user->name ?? '',
            'email' => $user->email ?? '',
            'phone' => $user->phone ?? '',
            'username' => $user->username ?? '',
        ];
    }

    /**
     * Check if user is authenticated
     * 
     * @return bool
     */
    protected function isAuthenticated()
    {
        return Auth::check();
    }

    /**
     * Get authenticated user ID
     * 
     * @return int|null
     */
    protected function getUserId()
    {
        return Auth::id();
    }

    /**
     * Get full authenticated user object
     * 
     * @return \App\Models\User|null
     */
    protected function getUser()
    {
        return Auth::user();
    }
}
