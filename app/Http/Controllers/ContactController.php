<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Resources\ContactResource;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        // $contacts = Contact::join('wards', 'contacts.ward_id', '=', 'wards.id')
        //     ->join('districts', 'wards.district_id', '=', 'districts.id')
        //     ->join('cities', 'districts.city_id', '=', 'cities.id')
        //     ->select('contacts.*', 'wards.name as ward_name', 'districts.name as district_name', 'cities.name as city_name')
        //     ->where('customer_id', '=', $id)
        //     ->get();
        // return response()->json($contacts);

        $contacts = Contact::with(['ward.district.city'])
                ->whereHas('customer', function($query) use ($id) {
                    $query->where('id', $id);
                })
                ->get();

        return response(ContactResource::collection($contacts));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $contact = new Contact;
        $contact->customer_id = $id;
        $contact->ward_id = $request->ward_id;
        $contact->address = $request->address;
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->save();
        return response()->json(['success'=>'true'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}