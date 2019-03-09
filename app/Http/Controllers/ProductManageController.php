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
                      'product_name'=>$request->get('product_name'),
                      'product_category'=>$request->get('product_category'),
                      'customer_type'=>$request->get('customer_type'),
                      'active_flag'=>$request->get('active_flag')
                    )
                );
        ProductMetaData::insert($data);

        $data1 = array(
                    array(
                      'product_name'=>$request->get('product_name'),
                      'product_category'=>$request->get('product_category'),
                      'customer_type'=>$request->get('customer_type'),
                      // 'active_flag'=>$request->get('active_flag'),
                      'product_details'=>$request->get('product_details'),
                      'product_keywords'=>$request->get('product_keywords'),
                      'product_prescription'=>$request->get('product_prescription'),
                      'product_for_disease'=>$request->get('product_for_disease'),
                      'product_ingredients'=>$request->get('product_ingredients'),
                      'imc_member_discount'=>$request->get('imc_member_discount'),
                      'product_image'=>$request->get('product_image'),
                    )
                );

        $productCategory = $request->get('product_category');

        switch($productCategory)
        {
          case 'home_care':
          {
            HomeCareProducts::insert($data1);
          }
          break;

          case 'beauty_care':
          {
            BeautyCareProducts::insert($data1);
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
