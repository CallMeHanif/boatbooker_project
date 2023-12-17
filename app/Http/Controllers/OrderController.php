<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarReturn;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function add_order(Car $car, Request $request)
    {
        // Validasi tanggal
        $validator = Validator::make($request->all(), [
            'rent_date' => 'required|date',
            'return_date' => 'required|date|after:rent_date'
        ]);

        // Periksa validasi
        if ($validator->fails()) {
            // Tindakan jika validasi gagal
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_id = Auth::id();
        $car_id = $car->id;

        $rentDate = new \DateTime($request->rent_date);
        $returnDate = new \DateTime($request->return_date);
        $cost = $returnDate->diff($rentDate)->days * $car->price;


        $payment = Payment::create([
            'user_id' => $user_id,
            'cost' => $cost
            // 'cost' =>
        ]);

        $order = Order::create([
            'car_id' => $car_id,
            'payment_id' => $payment->id,
            'rent_date' => $request->rent_date,
            'return_date' => $request->return_date,
        ]);

        CarReturn::create([
            'order_id' => $order->id
        ]);

        $car->status = "Tidak Tersedia";
        $car->save();

        return Redirect::route('show_order');
    }
    public function dashboard_order()
    {
        $orders = Order::all();
        return view('admin.dashboard_order', compact('orders'));
    }
    public function show_order()
    {
        $user_id = Auth::id();
        $orders = Order::whereHas('payment', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
        return view('show_order', compact('orders'));
    }

    public function dashboard_home()
    {
        $orders = Order::all();
        return view('admin.dashboard_home', compact('orders'));
    }
    public function dashboard_home_($range)
    {
        $currentDate = now();

        if ($range === 'week') {
            $startDate = $currentDate->startOfWeek()->format('Y-m-d H:i:s');
            $endDate = $currentDate->endOfWeek()->format('Y-m-d H:i:s');
            $orders = Order::whereBetween('return_date', [$startDate, $endDate])->get();
        } elseif ($range === 'month') {
            $startDate = $currentDate->startOfMonth()->format('Y-m-d H:i:s');
            $endDate = $currentDate->endOfMonth()->format('Y-m-d H:i:s');
            $orders = Order::whereBetween('return_date', [$startDate, $endDate])->get();
        } elseif ($range === 'year') {
            $startDate = $currentDate->startOfYear()->format('Y-m-d H:i:s');
            $endDate = $currentDate->endOfYear()->format('Y-m-d H:i:s');
            $orders = Order::whereBetween('return_date', [$startDate, $endDate])->get();
        }

        return view('admin.dashboard_home_', compact('orders'));
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
    
        if ($order && $order->is_paid == 0) {
            DB::transaction(function () use ($order) {
                // Retrieve the car associated with the order
                $car = $order->car;

                // Change the status of the car back to 'Tersedia'
                $car->update(['status' => 'Tersedia']);

                // Delete payment and order
                $order->payment()->delete();
                $order->delete();
            });

            return redirect()->back()->with('success', 'Order successfully canceled.');
        } else {
            return redirect()->back()->with('error', 'Cannot cancel a paid order or order not found.');
        }
    }

}