<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers'; //انما لو كان الجدول اسم تاني غير المودل ف لازم اكتبه هناoffersوالجدول اسمهofferكدا كدا هو بيشوف الجدول دا تلقائي عشان المودل اسمه 
    protected $fillable = ['id', 'name', 'price', 'datails', 'created_at', 'updated_at']; //دي الحاجات ال متشافه في الداتا بيز واقدر اعمل عليها اي عمليه
    protected $hidden = ['created_at', 'updated_at']; //دي الحاجات ال متشافه بس مبترجعش معايا في الريسبونس
    // public $timestamps = false; //وانا بضيف البيانات في الداتا بيزtime stampsدي في حالة اني لو مش عايز يظهرلي ال 
}
