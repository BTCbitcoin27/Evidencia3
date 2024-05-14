<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = new Order();
        $order->invoice_number = '303030';
        $order->customer_name = 'Cliente 1';
        $order->customer_number = '1001';
        $order->order_date = now();
        $order->status = 'Ordered';
        $order->delivery_address = 'Dirección del cliente 1';
        $order->notes = 'Notas adicionales para la orden del cliente 1';
        $order->save();

        $order = new Order();
        $order->invoice_number = '202020';
        $order->customer_name = 'Cliente 2';
        $order->customer_number = '1002';
        $order->order_date = now();
        $order->status = 'On route';
        $order->delivery_address = 'Dirección del cliente 2';
        $order->notes = 'Notas adicionales para la orden del cliente 2';
        $order->save();
    }
}
