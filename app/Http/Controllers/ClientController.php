<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\abonnement;
use Cron\MonthField;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('created_at', 'DESC')->paginate(20);
         return view('admin.client.index', compact('clients'));
    

        
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
        $this->validate($request, [
            'name' => 'required|unique:clients,name',
        ]);

        try {

            DB::beginTransaction();

            $client = Client::create([
                'name' => $request->name,
                'tele' => $request->tele,
                'asrn'=>$request->asrn,
                'dateDubet'=>$request->dateD,
                
                'image' => 'image.jpg',
    
            ]);
            if($request->hasFile('image')){
                $image = $request->image;
                $image_new_name = time() . '.' . $image->getClientOriginalExtension();
                $image->move('storage/post/', $image_new_name);
                $client->image = '/storage/post/' . $image_new_name;
                $client->save();
            }

            $abonnement = Abonnement::create([
                'date_dubet' => $request->dateD,
            
                'date_fine' => DB::raw('DATE_ADD(date_dubet, INTERVAL 1 MONTH)'),
                'payment'=>$request->pay,
                'client_id'=>$client->id,
            ]);

            

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                $e->getMessage()
            ]);
        }
        
      

       
       
        $request->session()->flash('success', 'Client created successfully');
        return redirect()->back();

        // Session::flash('success', 'Category created successfully');
        
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.client.edit', compact(['client']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        
       

         
        $client->name = $request->name;
        $client->tele = $request->tele;
        $client->asrn = $request->asrn; 
        $client->dateDubet = $request->dateD;

       
     

   

        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/post/', $image_new_name);
            $client->image = '/storage/post/' . $image_new_name;
        }

        $client->save();

        // Session::flash('success', 'Post updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Client $client)
    {
        if($client){
            if(file_exists(public_path($client->image))){
                unlink(public_path($client->image));
            }

            $client->delete();
            $request->session()->flash('success', 'Client Deleted successfully');
        }

        return redirect()->back();
    
    
    }
}
