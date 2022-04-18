<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
  protected $fillable = [
      'bill_id', 'name', 'quantity','price','tax'
  ];


  public function bill()
 {
     return $this->belongsTo('App\Bill');
 }

 public function totalprice()
{
    return $this->price*$this->quantity;
}
public function totalpercentage()
{
  $percentage = $this->tax;
  $total = $this->price*$this->quantity;

return ($percentage / 100) * $total;

}

public function totalamount()
{
  $total = $this->price*$this->quantity;;

return $total+$this->totalpercentage();

}
}
