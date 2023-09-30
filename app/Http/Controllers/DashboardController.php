<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        $pending = Order::where('status', 'pending')->get();
        $in_progress = Order::where('status', 'in_progress')->get();
        $completed = Order::where('status', 'completed')->get();
        $total = 0;
        $price = null;
        foreach ($orders as $order) {
            $total += $order->total_price;
        }
        $price = [];
        foreach ($completed as $complete) {
            $price[] = $complete->total_price;
        }
        $i = 0;
        while ($i < 12) {
            $months[] = Order::where('status', 'completed')->whereMonth('created_at', $i + 1)->max('total_price');
            if ($months[$i] == null) {
                $months[$i] = 0;
            }
            $i++;
        }
        return view('dashboard', [
            'orders' => $orders,
            'pending' => $pending,
            'in_progress' => $in_progress,
            'completed' => $completed,
            'total' => $total,
            'price' => $price,
            'months' => $months,
        ]);
    }
}
