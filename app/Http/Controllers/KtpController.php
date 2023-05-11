<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KTP;
use App\Helpers\formatAPI;
use Exception;

class KtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ktp::all();

        if($data){
            return formatAPI::createAPI(200,'Success',$data);
        }else{
            return formatAPI::createAPI(400,'Failed');
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $penduduk = ktp::create($request->all());
            
            $data = ktp::where('nik', '=',$penduduk->nik)->get();

            if($data){
                return formatAPI::createAPI(200,'success', $data);
            }else{
                return formatAPI::createAPI(400,'failed');
            }

        }catch(Exception $error){
            return formatAPI::createAPI(400,'failed', $error);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($penduduk)
    {
        try{
            $data = ktp::where('nik', '=', $penduduk)->first();

            if($data){
                return formatAPI::createAPI(200,'success', $data);
            }else{
                return formatAPI::createAPI(400,'failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400,'failed', $error);
        }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik)
    {
        try{
            $penduduk = ktp::findorfail($nik);
            $penduduk->update($request->all());

            $data = ktp::where('id','=',$penduduk->nik)->get();
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
            }else{
                return formatAPI::createAPI(400,'Failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400,'Failed',$error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        try{
            $penduduk = ktp::findorfail($nik);
            $data = $penduduk->delete();
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
            }else{
                return formatAPI::createAPI(400,'Failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400,'Failed',$error);
        }
    }
}
