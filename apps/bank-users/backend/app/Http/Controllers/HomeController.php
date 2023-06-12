<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function transferencia()
    {
        return view('transferencia');
    }
    public function cuenta()
    {
        $cuentas = [
            [
                'tipo' => 'Cuenta corriente',
                'saldo' => 5000,
                'nombre' => 'Cuenta 1',
                'numero_cuenta' => '1234567890'
            ],
            [
                'tipo' => 'Cuenta de ahorros',
                'saldo' => 10000,
                'nombre' => 'Cuenta 2',
                'numero_cuenta' => '0987654321'
            ],
        ];

        return view('cuenta', compact('cuentas'));
    }
}
