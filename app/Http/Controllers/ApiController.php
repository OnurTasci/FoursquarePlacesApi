<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use FoursquareApi;

class ApiController extends Controller
{

    public function getList(Request $request){

        $validator = Validator::make($request->all(), [
            'll' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validator error']);
        }else{

            $foursquare = new FoursquareApi(config('services.foursquare.client_id'),config('services.foursquare.secret_id'));

            $endpoint = "venues/explore";

            $params = array(
                'll' => $request->ll,
                'limit' => 50,
                'intent'=> 'match',
            );

            $response = $foursquare->GetPublic($endpoint,$params);

            return response($response);

        }
    }

    public function getDetail(Request $request){

        $validator = Validator::make($request->all(), [
            'placeId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Validator error']);
        }else{

            $foursquare = new FoursquareApi(config('services.foursquare.client_id'),config('services.foursquare.secret_id'));

            $endpoint = "venues/".$request->placeId;

            $response = $foursquare->GetPublic($endpoint);

            return response($response);
        }


    }


}
