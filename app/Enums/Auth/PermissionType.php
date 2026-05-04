<?php

namespace App\Enums\Auth;

enum PermissionType: string
{
    case ManageUsers = 'manage_users';
    case CreateCourses = 'create_courses';
    case EditCourses = 'edit_courses';
    case ViewCourses = 'view_courses';
    case ViewLogs = 'view_logs';
}
