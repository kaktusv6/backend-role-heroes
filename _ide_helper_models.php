<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Characteristic
 *
 * @property int $id
 * @property string $name
 * @property int $game_id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Game $game
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Characteristic whereUpdatedAt($value)
 */
	class Characteristic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employee whereUpdatedAt($value)
 */
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Game
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Characteristic[] $characteristics
 * @property-read int|null $characteristics_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserHero[] $heroes
 * @property-read int|null $heroes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 */
	class Game extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserHero[] $heroes
 * @property-read int|null $heroes_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserHero
 *
 * @property int $id
 * @property string $name
 * @property int $game_id
 * @property int $user_id
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Characteristic[] $characteristicValues
 * @property-read int|null $characteristic_values_count
 * @property-read \App\Models\Game $game
 * @property-read array $characteristic_values
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserHero whereUserId($value)
 */
	class UserHero extends \Eloquent {}
}

