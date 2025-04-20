<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Contact extends Model
    {
        protected $table = 'tbl_contact'; // Custom table name

        protected $primaryKey = 'id'; // Primary key column
      
        // Disabling Laravel's default timestamps
        public $timestamps = true;


          // Fillable attributes
          protected $fillable = [
            'id',
            'user_id',
            'fname',
            'mname',
            'lname',
            'phone',
            'email',
            'address',
            'deleted',
            'created_at',
            'updated_at',
            'modifyuser',
            'modifydate',

          ];


          // Date casting for consistent formatting
        protected $casts = [
            'createdate' => 'datetime',
            'modifydate' => 'datetime',
        ];


        public function user()
        {
            return $this->belongsTo(User::class, 'userid', 'id');
        }
    }
