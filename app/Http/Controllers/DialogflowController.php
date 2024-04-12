<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';
use Illuminate\Http\Request;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;
use App\Models\Category;
use App\Models\Product;
use DB;



class DialogflowController extends Controller
{

    public function process_1(Request $request)
    {

        putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\Apache24\htdocs\Backend_Test\credentials\try_3_1\try-laravel-3-nwsv-e1e8309d531e.json');

        $projectId = 'try-laravel-3-nwsv';
        $languageCode = 'es';

        $sessionsClient = new SessionsClient();
        $session = $sessionsClient->sessionName($projectId, uniqid());


    }

    public function quantity(Request $request)
    {


        $intent = $request->input('queryResult.intent.displayName');
        $category = $request->input('queryResult.parameters.category');

        if (empty($category)) {
            return response()->json(['fulfillmentText' => 'La categoría no puede estar vacía']);
        }

        $response = [];

        switch ($intent) {
            case 'getProductQuantity':

                $names = Category::pluck('name')->toArray();
                $names_min = array_map('strtolower', $names);
                $category_part = explode(" ", $category);
                $category_min = array_map('strtolower', $category_part);
                $resultado = array_intersect($names_min, $category_min);
                $categoryName_NS = reset($resultado);
                $categoryName = ucfirst($categoryName_NS);

                if (!empty($categoryName)) {
                    $categoria = Category::where('name', $categoryName)->first();
                    if ($categoria) {
                        $total = Product::where('category_id', $categoria->id)->sum('quantity');
                        return response()->json(['fulfillmentText' => 'Hay ' . $total . ' productos en la categoría ' . $categoryName . '.']);
                    } else {
                        response()->json(['fulfillmentText' => 'Lo siento, no pude encontrar la categoría' . $categoryName . '.']);
                    }
                } else {
                    return response()->json(['fulfillmentText' => 'Ingrese una categoria valida porfavor.']);
                }

                break;
            default:
                $response['fulfillmentText'] = "Lo siento, no entendí tu solicitud.";
                break;
        }

        // Devuelve la respuesta
        return response()->json($response);
    }




}



