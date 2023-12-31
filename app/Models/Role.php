<?php

// app/Models/Role.php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Notifications\Notifiable;
    use Laravel\Sanctum\HasApiTokens;

    class Role extends Model
    {
        use HasApiTokens, HasFactory, Notifiable;

        protected $fillable = ['name'];

        public function users()
        {
            return $this->belongsToMany(User::class, 'user_role');
        }
    }
