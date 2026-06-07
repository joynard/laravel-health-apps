<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Service;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTransactions = Transaction::with(['user', 'doctor', 'services'])->get();

        return view('transactions.index', ['transactions' => $allTransactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users   = User::all();
        $doctors = Doctor::all();
        $services= Service::all();

        return view('transactions.create', compact('users', 'doctors', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
            'service_id'=> 'required|exists:services,id',
            'quantity'  => 'required|integer|min:1',
        ]);

        $doctor  = Doctor::findOrFail($request->get('doctor_id'));
        $service = Service::findOrFail($request->get('service_id'));

        $consultationFee = $doctor->consultation_fee;
        $adminFee        = 5000;
        
        $totalPrice = $consultationFee + $adminFee + ($service->price * $request->get('quantity'));

        $transaction = new Transaction();
        $transaction->user_id            = $request->get('user_id');
        $transaction->doctor_id          = $request->get('doctor_id');
        $transaction->transaction_code   = 'TRX-' . strtoupper(Str::random(4)) . time();
        $transaction->schedule_time      = now()->addDays(1);
        $transaction->consultation_fee   = $consultationFee;
        $transaction->admin_fee          = $adminFee;
        $transaction->total_price        = $totalPrice;
        $transaction->payment_method     = 'transfer';
        $transaction->payment_status     = 'pending';
        $transaction->transaction_status = 'waiting';
        $transaction->save();

        $transaction->services()->attach($service->id, [
            'quantity'   => $request->get('quantity'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Successfully created transaction.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with(['user', 'doctor', 'services'])->findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'payment_status'     => 'required|in:pending,paid,failed',
            'transaction_status' => 'required|in:waiting,ongoing,completed,cancelled',
        ]);

        $transaction->payment_status     = $request->get('payment_status');
        $transaction->transaction_status = $request->get('transaction_status');
        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            $transaction->delete();
            return redirect()->route('transactions.index')->with('success', 'Data transaksi berhasil dihapus.');
        } catch (\PDOException $ex) {
            return redirect()->route('transactions.index')->with('status', 'Gagal menghapus data! Transaksi ini masih memiliki data terkait yang tidak bisa dihapus.');
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Transaction::findOrFail($id);
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('transactions.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Transaction::findOrFail($id);
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('transactions.getEditFormB', compact('data'))->render()
        ), 200);
    }

    public function saveDataUpdate(Request $request)
    {
        $request->validate([
            'id'                 => 'required|exists:transactions,id',
            'payment_status'     => 'required|in:pending,paid,failed',
            'transaction_status' => 'required|in:waiting,ongoing,completed,cancelled',
        ]);

        $id = $request->id;
        $data = Transaction::findOrFail($id);
        $data->payment_status     = $request->payment_status;
        $data->transaction_status = $request->transaction_status;
        $data->save();

        return response()->json(array(
            'status' => 'oke',
            'msg' => 'transaction status is up-to-date !'
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Transaction::findOrFail($id);
        $data->delete();
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => 'transaction data is removed !'
        ), 200);
    }
}
