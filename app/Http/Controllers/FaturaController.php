<?php

namespace App\Http\Controllers;

use App\Fatura;
use Illuminate\Http\Request;

class FaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!(Gate::denies('read_fatura'))){

           
            }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!(Gate::denies('create_fatura'))){

           
            }
        }
        else{
            return view('errors.403');
        }
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
        if(!(Gate::denies('create_fatura'))){

           
            }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function show(Fatura $fatura)
    {
        //
        if(!(Gate::denies('read_fatura'))){

           
            }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Fatura $fatura)
    {
        //
        if(!(Gate::denies('update_fatura'))){

           
            }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fatura $fatura)
    {
        //
        if(!(Gate::denies('update_fatura'))){

           
            }
        }
        else{
            return view('errors.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fatura $fatura)
    {
        //
        if(!(Gate::denies('delete_fatura'))){

           
            }
        }
        else{
            return view('errors.403');
        }
    }
}
