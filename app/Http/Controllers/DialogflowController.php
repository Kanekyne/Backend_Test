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
        $category = $request->input('queryResult.parameters.category');

        if (empty($category)) {
            return response()->json(['fulfillmentText' => 'La categoría no puede estar vacía']);
        }
        $names = Category::pluck('name')->toArray();
        $names_min = array_map('strtolower', $names);
        $category_part = explode(" ", $category);
        $category_min = array_map('strtolower', $category_part);
        $resultado = array_intersect($names_min, $category_min);
        $categoryName_NS = reset($resultado);
        $categoryName = ucfirst($categoryName_NS);


        if (!empty($resultado)) {
            $categoria = Category::where('name', $categoryName)->first();
            if ($categoria) {
                $total = Product::where('category_id', $categoria->id)->sum('quantity');
                return response()->json(['fulfillmentText' => 'Hay ' . $total . ' productos en la categoría ' . $categoryName]);
            } else {
                return response()->json(['fulfillmentText' => 'No hay coincidencias']);
            }
        } else {
            echo "No hay coincidencias";
        }
    }

        public function process(Request $request)
    {
        // Extrae la intención de la solicitud de Dialogflow
        $intent = $request->input('queryResult.intent.displayName');

        // Extrae los parámetros de la solicitud de Dialogflow
        $parameters = $request->input('queryResult.parameters');

        // Inicializa la respuesta
        $response = [];

        // Procesa la intención
        switch ($intent) {
            case 'getProductQuantity':
                // Extrae la categoría de los parámetros
                $categoryName = $parameters['category'];

                // Busca la categoría en la base de datos
                $category = Category::where('name', $categoryName)->first();

                if ($category) {
                    // Si la categoría existe, calcula la cantidad total de productos
                    $total = Product::where('category_id', $category->id)->sum('quantity');

                    // Configura la respuesta
                    $response['fulfillmentText'] = "Hay {$total} productos en la categoría {$categoryName}.";
                } else {
                    // Si la categoría no existe, configura la respuesta
                    $response['fulfillmentText'] = "Lo siento, no pude encontrar la categoría {$categoryName}.";
                }

                break;

            // Añade más casos para otras intenciones según sea necesario

            default:
                $response['fulfillmentText'] = "Lo siento, no entendí tu solicitud.";
                break;
        }

        // Devuelve la respuesta
        return response()->json($response);
    }



}



