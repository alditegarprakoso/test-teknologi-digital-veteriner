<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vendingMachine extends Controller
{
    private $items = [
        'Biskuit' => 6000,
        'Chips' => 8000,
        'Oreo' => 10000,
        'Tango' => 12000,
        'Cokelat' => 15000,
    ];

    private $stock = [
        'Biskuit' => 3,
        'Chips' => 3,
        'Oreo' => 3,
        'Tango' => 3,
        'Cokelat' => 3,
    ];
    
    private $initialCoin = [2000, 5000, 10000, 20000, 50000];

    private $balance = 0;

    public function index()
    {
        return view('home', ['initialCoin' => $this->initialCoin, 'items' => $this->items]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'coin' => ['required', 'numeric', 'min:1'],
            'qty' => ['required', 'numeric', 'min:1']
        ]);

        $coinInput = $request->coin;
        $itemInput = $request->item;
        $qtyInput = $request->qty;

        $validationStock = $this->checkStock($qtyInput, $itemInput);
        
        if ($validationStock == false) {
            return redirect()->route('vendingMachine.index')->with('error', 'Maaf, tidak bisa membeli karena stock tidak cukup.');
        }

        $validationCoin = $this->insertCoin($coinInput);
        
        if ($validationCoin == false) {
            return redirect()->route('vendingMachine.index')->with('error', 'Tolong masukkan coin sesuai berdasarkan pecahan list yang ditampilkan.');
        }

        $purchase = $this->purchase($itemInput, $qtyInput);

        if ($purchase == false) {
            return redirect()->route('vendingMachine.index')->with('error', 'Maaf uang anda tidak cukup untuk membeli.');
        }

        $returnCoin = $this->returnCoin();

        return redirect()->route('vendingMachine.index')->with('success', 'Selamat anda berhasil order, kembalian anda Rp. ' . $returnCoin);
    }

    public function insertCoin($coin)
    {
        if ($coin == 2000 || $coin == 5000 || $coin == 10000 || $coin == 20000 || $coin == 50000) {
            $this->balance += $coin;
            return true;
        } else {
            return false;
        }
    }
    
    public function checkStock($qty, $item)
    {
        if (intval($qty) > $this->stock[$item]) {
            return false;
        } else {
            return true;
        }
    }

    public function purchase($item, $qty)
    {
        $total = $this->items[$item] * intval($qty);
        if ($this->balance >= $total) {
            $this->balance -= $total;
            return true;
        } else {
            return false;
        }
    }

    public function returnCoin()
    {
        $coin = $this->balance;
        $this->balance = 0;
        return $coin;
    }
}
