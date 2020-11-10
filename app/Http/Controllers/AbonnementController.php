<?php

namespace App\Http\Controllers;

use App\Models\abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbonnementController extends Controller
{
public function __construct(){

$this->middleware('auth');
}

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        $abonnements = DB::table('clients')->join('abonnements', 'abonnements.client_id', '=', 'clients.id')
        
        ->select()
                ->whereRaw('date_fine <= NOW()')
                
                ->orderBy('date_fine', 'desc')
                ->get();
      
         return view('admin.abonnement.index', compact('abonnements'));
    }

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function pay()
    {
        
    
        $abonnementsP = DB::table('clients')->join('abonnements', 'abonnements.client_id', '=', 'clients.id')
        ->select()
                ->whereRaw('date_fine > NOW()')
                
                ->orderBy('date_fine', 'desc')
                ->get();

             
      
         return view('admin.abonnement.pay' , compact('abonnementsP'));
    

        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/client/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\abonnement  $abonnement
     * @return \Illuminate\Http\Response
     */
    public function show(abonnement $abonnement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\abonnement  $abonnement
     * @return \Illuminate\Http\Response
     */
    public function edit(abonnement $abonnement)
    {
        return view('admin.abonnement.edit', compact(['abonnement']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\abonnement  $abonnement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, abonnement $abonnement )
    {
    
        

        $abonnement->payment = $request->pay; 
        $abonnement->date_dubet = $request->dateD;
        $abonnement->date_fine = DB::raw('DATE_ADD(date_dubet, INTERVAL 1 MONTH)');

       
     

        $abonnement->save();

        // Session::flash('success', 'Post updated successfully');
        return redirect()->back();
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\abonnement  $abonnement
     * @return \Illuminate\Http\Response
     */
    public function updateTow(Request $request, abonnement $abonnement )
    {
    
        

        $abonnement->payment = $request->pay; 
        $abonnement->date_dubet = $request->dateD;
        $abonnement->date_fine = DB::raw('DATE_ADD(date_dubet, INTERVAL 1 MONTH)');

       
     

        $abonnement->save();

        // Session::flash('success', 'Post updated successfully');
        return redirect()->back();
    }

/**
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\abonnement  $abonnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(abonnement $abonnement)
    {
        //
    }
}
