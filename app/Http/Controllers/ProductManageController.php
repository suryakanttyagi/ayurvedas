<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Model\ProductMetaData;
use App\Model\HomeCareProducts;
use App\Model\BeautyCareProducts;
use Illuminate\Support\Facades\Log;

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
                      'product_name'=>$request->input('rqBody.product_name'),
                      'product_category'=>$request->input('rqBody.product_category'),
                      'customer_type'=>$request->input('rqBody.customer_type'),
                      'active_flag'=>$request->input('rqBody.active_flag')
                    )
                );
        // ProductMetaData::insert($data);

        $data1 = array(
                    array(
                      'product_image'=>$request->input('rqBody.product_image'),
                      'product_name'=>$request->input('rqBody.product_name'),
                      'product_category'=>$request->input('rqBody.product_category'),
                      // 'customer_type'=>$request->input('customer_type'),
                      // 'active_flag'=>$request->input('active_flag'),
                      'product_details'=>$request->input('rqBody.product_details'),
                      'product_prescription'=>$request->input('rqBody.product_prescription'),
                      'product_for_disease'=>$request->input('rqBody.product_for_disease'),
                      'product_ingredients'=>$request->input('rqBody.product_ingredients'),
                      'product_keywords'=>$request->input('rqBody.product_keywords'),
                      'imc_member_discount'=>$request->input('rqBody.imc_member_discount'),
                    )
                );
      Log::info($request->input('rqBody.product_img'));
      Log::info($request);
        $productCategory = $request->input('rqBody.product_category');

        switch($productCategory)
        {
          case 'home_care':
          {
            // HomeCareProducts::insert($data1);
            Log::info('home care');
          }
          break;

          case 'beauty_care':
          {
            // BeautyCareProducts::insert($data1);
            Log::info('beauty care');
          }
          break;

          default:
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
