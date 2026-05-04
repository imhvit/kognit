<?php

namespace App\Enums\Auth;

enum RoleType: string
{
    case Admin = 'admin';
    case Teacher = 'teacher';
    case Student = 'student';
}
