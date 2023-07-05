<?php

namespace App\Http\Controllers\API;

use App\Models\Apartment;
use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $apartments = Apartment::with(['apartment_type', 'services'])->orderByDesc('id')->paginate(6);

        if (count($apartments) > 0) {
            return response()->json([
                'success' => true,
                'apartments' => $apartments
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function show($slug) {
        $apartment = Apartment::with(['apartment_type', 'services'])->where("slug", $slug)->get();
        if ($apartment) {
            return response()->json([
                "success" => true,
                "apartment" => $apartment[0],
            ]);
        } else {
            return response()->json([
                "success" => false,
            ]);
        }
    }
}
