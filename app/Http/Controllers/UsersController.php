<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Domfpdf\Domfpdf;
use Jithesh\Fpdf\FPDF;

class UsersController extends Controller
{


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    public function fpdfexport()
    {
        //     // instantiate and use the domfpdf class
        //     $domfpdf = new Domfpdf();
        //     $view = view('fpdfteste');
        //    return view('fpdfteste');
        //     $domfpdf->loadHtml($view);
        //     // (Optional) Setup the paper size and orientation
        //     // $domfpdf->setPaper('A4', 'landscape');
        //     $domfpdf->setPaper('A4', 'portrait');
        //     // Render the HTML as fpdf
        //     $domfpdf->render();
        //     // Output the generated fpdf to Browser
        //     $domfpdf->stream('teste.fpdf');


        return view('Pdfteste');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
