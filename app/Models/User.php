<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "users";
    protected $primaryKey = "user_id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_address',
        'user_email',
        'user_phonenumber',
        'user_password',
        'user_isadmin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_password' => 'hashed',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->user_password;
    }


    public static function paginate(array $column, int $limit, int $offset, array $sort, ?array $betweens, string $search = '')
    {
        $query = DB::table('users')
            ->select($column)
            ->where(function ($query) use ($search) {
                $query->where("user_name", "like", "%$search%")
                    ->orWhere("user_username", "like", "%$search%")
                    ->orWhere("user_address", "like", "%$search%")
                    ->orWhere("user_email", "like", "%$search%")
                    ->orWhere("user_phonenumber", "like", "%$search%");
            });

        foreach ($betweens as $between) {
            if ($between["column"]) {
                $query->whereBetween($between["column"], [$between["start"], $between["end"]]);
            }
        }
        foreach ($sort as $value) {
            $query->orderBy($value['column'], $value['order']);
        }


        $query->offset($offset)
            ->limit($limit);

        $result = $query->get();
        return $result->toArray();
    }

    public static function countResult(string $search, array $betweens)
    {
        $query = DB::table('users')
            ->select()
            ->where(function ($query) use ($search) {
                $query->where("user_name", "like", "%$search%")
                    ->orWhere("user_username", "like", "%$search%")
                    ->orWhere("user_address", "like", "%$search%")
                    ->orWhere("user_email", "like", "%$search%")
                    ->orWhere("user_phonenumber", "like", "%$search%");
            });
        if ($betweens) {
            foreach ($betweens as $between) {
                if ($between["column"]) {
                    $query->whereBetween($between["column"], [$between["start"], $between["end"]]);
                }
            }
        }

        return $query->count();
    }



}
