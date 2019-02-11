<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\ProductMetaData;
use App\Model\HomeCareProducts;
use App\Model\BeautyCareProducts;

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
                    );
                );
        ProductMetaData::insert($data);

        $data1 = array(
                    array(
                      'product_name'=>$request->get('product_name'),
                      'product_category'=>$request->get('product_category'),
                      'customer_type'=>$request->get('customer_type'),
                      'active_flag'=>$request->get('active_flag'),
                      'product_details'=>$request->get('product_details'),
                      'product_keywords'=>$request->get('product_keywords'),
                      'product_prescription'=>$request->get('product_prescription'),
                      'product_for_disease'=>$request->get('product_for_disease'),
                      'product_ingredients'=>$request->get('product_ingredients'),
                      'imc_member_discount'=>$request->get('imc_member_discount'),
                      'product_image'=>$request->get('product_image'),
                    );
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
}
