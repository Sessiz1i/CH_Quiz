<?php

    namespace App\Models;

    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Quiz extends Model
    {
        use HasFactory;


        protected $fillable = ['title', 'slug', 'description', 'status', 'finished_at'];
        protected $dates = ['finished_at'];
        // Sutun ekleme
        protected $appends = ['average', 'joinUsers', 'user', 'myRank'];

        public function getmyRankAttribute()
        {
            $myRank = 0;
            foreach ($this->results()->orderByDesc('point')->get() as $results) {
                $myRank++;
                if (auth()->user()->id == $results->user_id) {
                    return $myRank;
                }
            }
        }

        public function getAverageAttribute()
        {
            if ($this->results()->count() > 0) {
                return round($this->results()->avg('point'));
            }
            return null;
        }

        public function getJoinUsersAttribute()
        {
            if ($this->results()->count() > 0) {
                return $this->results()->count('user_id');
            }
            return null;
        }

        public function getUserAttribute()
        {
            if (isset(auth()->user()->id)) {
                if ($this->results()->count() > 0) {
                    return auth()->user()->id;
                }
            }
            return null;
        }

        //-----------------
        // Tarih formatı eklendi
        public function getFinishedAttribute($date)
        {
            return $date ? Carbon::parse($date) : null;
        }

        //-----------------
        public function questions()
        {
            return $this->hasMany(Question::class, 'quiz_id', 'id');
        }

        public function topTen()
        {
            return $this->results()->orderByDesc('point')->take(10);
        }

        public function results()
        {

            return $this->hasMany(Result::class);
        }

        public function my_result()
        {
            if (isset(auth()->user()->id)) {
                return $this->hasOne(Result::class)->where('user_id', auth()->user()->id);
            }
            return null;
        }


    }

