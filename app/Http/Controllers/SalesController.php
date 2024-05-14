<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Order;

class SalesController extends Controller
{
    public function index(): Response
    {
        $orders = Order::all();
        return Inertia::render('Sales/Index', ['orders' => $orders]);
    }

    public function create()
    {
        return Inertia::render('Sales/Create');
    }

    public function edit($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return Inertia::render('Sales/Edit', ['order' => $order]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required',
            'customer_name' => 'required',
            'customer_number' => 'required',
            'order_date' => 'required',
            'delivery_address' => 'required',
        ]);

        Order::create($request->all());

        return redirect()->route('sales.index');
    }
}
