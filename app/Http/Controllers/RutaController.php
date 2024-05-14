<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use Inertia\Response;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('status', 'In Process')->get();
        return Inertia::render('Ruta/Index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function updateStatus(Order $order, Request $request)
    {
        $order->update(['status' => $request->status]);
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // app/Http/Controllers/RutaController.php

    public function uploadImage1(Order $order, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'1.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Here you can save the image path to the order
        $order->image_path1 = '/images/'.$imageName;
        $order->status = 'In route';
        $order->save();

        return response()->json(['status' => 'success']);
    }

    public function uploadImage2(Order $order, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'2.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Here you can save the image path to the order
        $order->image_path2 = '/images/'.$imageName;
        $order->status = 'Delivered';
        $order->save();

        return response()->json(['status' => 'success']);
    }
}
