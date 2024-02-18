<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::with('client')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('orders.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:255|unique:orders,order_number',
            'client_id' => 'required|exists:clients,id',
            'nama_item' => 'required|string|max:255',
            'harga_item' => 'required|numeric',
            'tanggal_order' => 'required|date',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $clients = Client::all();
        return view('orders.edit', compact('order', 'clients'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_number' => 'required|string|max:255|unique:orders,order_number,' . $order->id,
            'client_id' => 'required|exists:clients,id',
            'nama_item' => 'required|string|max:255',
            'harga_item' => 'required|numeric',
            'tanggal_order' => 'required|date',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function generatePDF()
    {
        $orders = Order::with('client')->get();
        $pdfView = View::make('orders.pdf', compact('orders'))->render();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($pdfView);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('orders.pdf');
    }
}
