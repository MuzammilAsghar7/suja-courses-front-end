<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions_ids(){
        return Attempt::where('user_id', $this->id)->pluck('question_id')->toArray();
    }

    public function all_questions(){
        $modules = module::get();
        $collection = [];
        foreach($modules as $module){
            $chapters = $module->chapters_with_lesson;
            foreach($chapters as $chapter){
                $lessons = $chapter->lessons;
                foreach($lessons as $key => $lesson){
                    $childrens = $lesson->children;
                    if(count($childrens) > 0)
                    {
                        foreach($childrens as $key => $children){
                            //$collection[] = $children->questions->pluck('id');
                        }
                    }
                    else
                    {
                        $collection[] = $lesson->questions->pluck('id');
                    }
                }
            }
        }
        $singleArray = Arr::flatten($collection);
        return $singleArray;
    }
}
