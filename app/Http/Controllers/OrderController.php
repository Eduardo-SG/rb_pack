<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Client;
use App\Models\Part;
use App\Models\Process;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::paginate(5);
        $users = User::pluck("name", "id");
        $clients = Client::pluck('client_name', 'id'); 
        $parts = Part::pluck('part_num', 'id'); 
        $processes = Process::pluck('process_name', 'id'); 
        return view('orders.index', compact('orders', 'users', 'clients', 'parts', 'processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clients = Client::pluck("client_name", "id");
        $parts = Part::pluck("part_num", "id");
        $processes = Process::pluck("process_name", "id");
        $selectedID = 0; 
        return view('orders.create', compact('clients', 'parts', 'processes', 'selectedID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'order_num' => 'required',
            'user_id' => 'required',
            'client_id' => 'required',
            'part_id' => 'required',
            'process_id' => 'required',
            'due_date' => 'required',
        ]);
        Order::create($request->all());
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $client = Client::pluck("client_name", "id");
        $part = Part::pluck("part_num", "id");
        $process = Process::pluck("process_name", "id");
        $selectedID = 0; 
        $order = Order::find($id);
        return view('orders.edit', compact('order', 'client', 'part', 'process', 'selectedID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $request->validate([
            'order_num' => 'required',
            'user_id' => 'required',
            'client_id' => 'required',
            'part_id' => 'required',
            'process_id' => 'required',
            'due_date' => 'required',
        ]);
        $order->update($request->all());
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        return redirect()->route('orders.index')->with('del', 'ok');
    }
}
