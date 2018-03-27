<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Auth;

class Course extends Model
{   
    public function business() {
        return $this->belongsTo(User::class, 'business_id', 'business_id');
    }
    
    public static function displaySearch($courses) {
        foreach ($courses as $course) {
            $desc = explode(' ', $course->description);
            $desc = array_slice($desc, 0, 23);
            if (count($desc) < 23) {
                $desc[] = "&hellip;";
                for ($i = 0; $i < 21; $i++) {
                    array_push($desc, ' ');
                }
                $course->description = implode($desc);
            } else {
                array_push($desc, '&hellip;');
                $course->description = implode($desc);

            }
        }
        return $courses;
    }
    
    public function buy($token) {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        
        if ($customer = DB::table('customers')->where('user_id', Auth::id())->first()) {
            $charge = Charge::create(array(
                'amount' => $this->cost,
                'currency' => "usd",
                'customer' => $customer->cus_id,
            ));
            
            Auth::user()->courses()->attach($this->id);
        } else {
            $customer = Customer::create(array(
                'email' => Auth::user()->email,
                'source' => $token,
            ));
            
            // Charge the Customer instead of the card:
            $charge = Charge::create(array(
                'amount' => $this->cost,
                'currency' => "usd",
                'customer' => $customer->id
            ));
            
            DB::table('customers')->insert([
                'email' => Auth::user()->email,
                'cus_id' => $customer->id,
                'source' => $token,
                'user_id' => Auth::id(),
            ]);
            Auth::user()->courses()->attach($this->id);
        }
    }
}