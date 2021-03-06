<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Model\ProductMetaData;
use App\Model\HomeCareProducts;
use App\Model\BeautyCareProducts;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProductManageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
      return $request->all();
    }

   /*
      method to add products to the database
   */

    public function addProductToDb(Request $request)
    {

        $data = array(
                    array(
                      'product_image'=>$request->input('rqBody.product_image'),
                      'product_name'=>strtolower(trim($request->input('rqBody.product_name'))),
                      'product_category'=>$request->input('rqBody.product_category'),
                      'created_at'=>Carbon::now()->toDateTimeString(),
                      'updated_at'=>Carbon::now()->toDateTimeString(),
                      // 'customer_type'=>$request->input('rqBody.customer_type'),
                      // 'active_flag'=>1
                    )
                );
                // Log::info($request);
                // Log::info($data);

        $data1 = array(
                    array(
                      'product_image'=>$request->input('rqBody.product_image'),
                      'product_name'=>strtolower(trim($request->input('rqBody.product_name'))),
                      'product_category'=>$request->input('rqBody.product_category'),
                      // 'customer_type'=>$request->input('customer_type'),
                      // 'active_flag'=>1,
                      'product_details'=>$request->input('rqBody.product_details'),
                      'product_prescription'=>$request->input('rqBody.product_prescription'),
                      'product_for_disease'=>$request->input('rqBody.product_for_disease'),
                      'product_ingredients'=>$request->input('rqBody.product_ingredients'),
                      'product_keywords'=>$request->input('rqBody.product_keywords'),
                      'product_cost'=>$request->input('rqBody.product_cost'),
                      'imc_member_discount'=>$request->input('rqBody.imc_member_discount'),
                      'created_at'=>Carbon::now()->toDateTimeString(),
                      'updated_at'=>Carbon::now()->toDateTimeString(),
                    )
                );
      // Log::info($request->input('rqBody.product_img'));
      // Log::info($data1);
        $productCategory = $request->input('rqBody.product_category');

        switch($productCategory)
        {
          case 'home_care':
          {
            ProductMetaData::insert($data);
            HomeCareProducts::insert($data1);
            Log::info('home care');
            return response()->json(['rsBody' => ['result' =>'success','msg' => 'Saved successfully']]);

          }
          break;

          case 'beauty_care':
          {
            ProductMetaData::insert($data);
            BeautyCareProducts::insert($data1);
            Log::info('beauty care');
            return response()->json(['rsBody' => ['result' =>'success','msg' => 'Saved successfully']]);
          }
          break;

          default:
            return response()->json(['rsBody' => ['result' =>'error','msg' => 'Something went wrong while saving']]);
          break;

        }
    }


/*
  Add product image to the destination folder
*/
public function uploadProductImage(Request $request)
{
      // $validator=Validator::make($request->toArray(),[
      //         'file' => 'required|mimes:jpeg,png,jpg,gif,svg|max:1024',
      //     ]
      // );
      // if($validator->fails()){
      //     return response()->json(['rsBody' => ['result' =>'Business Error','msg' => 'Either file format or file size is not correct']]);
      // }
      Log::info( $request );
      if ($request->hasFile('file'))
      {
          $image = $request->file('file');
          $name = $image->getClientOriginalName();
          $destinationPath = $_ENV['IMC_PRODUCT_PICTURE_STORE_PATH'];
          //$image->move($destinationPath, time().'.'.$name);
          $image->move($destinationPath, $name);
          $basePath = $_ENV['IMC_PRODUCT_PICTURE_STORE_PATH'].$name;
      }
      return response()->json(['rsBody' => ['result' => 'success','filePath'=>$basePath,'fileName'=>$name,'DBName'=>$name]]);
  }
}
