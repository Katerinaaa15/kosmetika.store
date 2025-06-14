<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(columns:'count')->withTimestamps();
    }

    



    public function getFullPrice() {
        $sum=0;
        foreach ($this->products as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    public function saveOrder($name, $phone, $email) {
        if ($this->status==0){
        $this->name=$name;
        $this->phone=$phone;
        $this->email=$email;
        $this->status=1;
        $this->save();
        session()->forget(keys:'orderId');
        return true;
        }else{
            return false;
        }
    }
}
