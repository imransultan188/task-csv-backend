<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\IndustryCSVJob;
use App\Models\Industry;

class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $industry = Industry::all();
         return response()->json([
              'message' => 'Industry data',
              'data' => $industry
         ], 200);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function uploadCSV(Request $request)
     {
        dd('dd check');
        return response()->json( 'check') ;

        if( $request->has('csv') ){
           
            $file = $request->file('file');
            $chunks = array_chunk(file($file), 1000);
            $header = str_getcsv(array_shift($chunks[0]));

            foreach ($chunks as $chunk) {
                IndustryCSVJob::dispatch($chunk, $header);
            }
            return response()->json([
                'message' => 'CSV file uploaded successfully'
            ], 200);

        }
        // if ($request->file('file')) {
        //     return response()->json([
        //         'message' => 'CSV file uploaded successfully'
        //     ], 200);
        //     $file = $request->file('file');
        //     $chunks = array_chunk(file($file), 1000);
        //     $header = str_getcsv(array_shift($chunks[0]));

        //     foreach ($chunks as $chunk) {
        //         IndustryCSVJob::dispatch($chunk, $header);
        //     }
        //     return response()->json([
        //         'message' => 'CSV file uploaded successfully'
        //     ], 200);

        // }

        // if( $request->has('csv') ){
        //     $file = $request->file('csv');
        //     $chunks = array_chunk(file($file), 1000);
        //     $header = str_getcsv(array_shift($chunks[0]));

        //     return response()->json([
        //         'message' => 'CSV file uploaded successfully'
        //     ], 200);

        //     foreach ($chunks as $chunk) {
        //         IndustryCSVJob::dispatch($chunk, $header);
        //     }
        //     return response()->json([
        //         'message' => 'CSV file uploaded successfully'
        //     ], 200);

        // }

        return response()->json([
            'message' => 'CSV file not uploaded'
        ], 400);

      
     }

    public function store(Request $request)
    {
        $industry = new Industry;
        $industry->year = $request->year;
        $industry->Industry_aggregation_NZSIOC = $request->Industry_aggregation_NZSIOC;
        $industry->Industry_code_NZSIOC = $request->Industry_code_NZSIOC;
        $industry->Industry_name_NZSIOC = $request->Industry_name_NZSIOC;
        $industry->Units = $request->Units;
        $industry->Variable_code = $request->Variable_code;
        $industry->Variable_name = $request->Variable_name;
        $industry->Variable_category = $request->Variable_category;
        $industry->Value = $request->Value;
        $industry->Industry_code_ANZSIC06 = $request->Industry_code_ANZSIC06;
        $industry->save();
        return response()->json([
            'message' => 'Industry created successfully',
            'data' => $industry
        ], 200);

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
        
        $industry = Industry::find($id);
        $industry->delete();
        $industry = Industry::all();
        return response()->json([
            'message' => 'Industry deleted successfully',
            'data' => $industry
        ], 200);

    }
}
