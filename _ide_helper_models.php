<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $course_code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseClass> $courseClasses
 * @property-read int|null $course_classes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCourseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereUpdatedAt($value)
 */
	class Course extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $course_class_id
 * @property int $user_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseClass $course_class
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant whereCourseClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseAttendant whereUserId($value)
 */
	class CourseAttendant extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $assigned_regular_class_id
 * @property string $course_class_code
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon $start_date
 * @property int $course_id
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseAttendant|null $pivot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $attendants
 * @property-read int|null $attendants_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereAssignedRegularClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereCourseClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseClass whereUpdatedAt($value)
 */
	class CourseClass extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $class_code
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $regular_lecturer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $regular_students
 * @property-read int|null $regular_students_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RegularClass whereUpdatedAt($value)
 */
	class RegularClass extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property int|null $regular_class_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\RegularClass|null $regular_class
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRegularClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

