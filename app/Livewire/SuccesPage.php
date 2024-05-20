<?php

namespace App\Livewire;

use Stripe\Stripe;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Url;
use Stripe\Checkout\Session;
use Livewire\Attributes\Title;

#[Title('Success - DcodeMania')]
class SuccesPage extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {
        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();

        if($this->session_id) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);

            if($session_info->payment_status != 'paid') {
                $latest_order->payment_status = 'failed';
                $latest_order->save();
                return redirect->route('cancel');
            } else if($session_info->payment_status == 'paid') {
                $latest_order->payment_status = 'paid';
                $latest_order->save();
            }
        }

        return view('livewire.succes-page', [
            'order' => $latest_order,
        ]);
    }
}
