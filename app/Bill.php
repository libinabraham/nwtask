<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{

  protected $fillable = [
      'user_id', 'bill_no', 'discount_type','discount'
  ];



  public function bill_details()
 {
     //return $this->hasMany(Bill_detail::class);
     return $this->hasMany('App\Bill_detail','bill_id')->orderBy('id');
 }
 public function user()
{
    //return $this->hasMany(Bill_detail::class);
    return $this->belongsTo('App\User');
}

 public static function boot() {
        parent::boot();

        static::deleting(function($bill) { // before delete() method call this
             $bill->bill_details()->delete();
             // do the rest of the cleanup...
        });
    }

    public function discount($subtotal)
    {
      $disamount =0;$distype = $this->discount_type;$disvalue =$this->discount;

      if($distype =='amount'){$disamount =$disvalue;}else{$disamount =($disvalue/100)*$subtotal;}

    return $disamount;

    }

}
