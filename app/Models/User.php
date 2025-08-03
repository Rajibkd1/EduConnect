<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'user_id');
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class, 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function supportStaff()
    {
        return $this->hasOne(SupportStaff::class, 'user_id');
    }

    public function developer()
    {
        return $this->hasOne(Developer::class, 'user_id');
    }

    /**
     * Check if user is a student
     */
    public function isStudent()
    {
        return $this->user_type === 'student';
    }

    /**
     * Check if user is a tutor
     */
    public function isTutor()
    {
        return $this->user_type === 'tutor';
    }

    /**
     * Check if user is a guardian
     */
    public function isGuardian()
    {
        return $this->user_type === 'guardian';
    }

    /**
     * Get navigation items based on user type
     */
    public function getNavigationItems()
    {
        if ($this->isTutor()) {
            return [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z'
                ],
                [
                    'name' => 'Profile',
                    'route' => 'profile.show',
                    'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
                ],
                [
                    'name' => 'Session Requests',
                    'route' => 'session-requests',
                    'icon' => 'M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z'
                ],
                [
                    'name' => 'Create Sessions',
                    'route' => 'create-sessions',
                    'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6'
                ]
            ];
        } else {
            // For students and guardians
            return [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z'
                ],
                [
                    'name' => 'Profile',
                    'route' => 'profile.show',
                    'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
                ],
                [
                    'name' => 'Search Tutor',
                    'route' => 'search-tutor',
                    'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'
                ],
                [
                    'name' => 'Sessions',
                    'route' => 'sessions',
                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                ],
                [
                    'name' => 'Feedback',
                    'route' => 'feedback',
                    'icon' => 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z'
                ]
            ];
        }
    }
}
