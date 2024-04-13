<?php

namespace App\Http\Controllers;

// require 'vendor/autoload.php';
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;



class DialogflowController extends Controller
{

    public function quantity(Request $request)
    {


        ###################  region  #######################

        $intent = $request->input('queryResult.intent.displayName'); //Extraccion de la intent que esta enviando la solicitud
        $category = $request->input('queryResult.parameters.category'); //Extraccion del valor del parametro
        if ($intent == 'getProductQuantity' && empty($category)) {
            return response()->json(['fulfillmentText' => 'La categoría no puede estar vacía']);
        }
        $response = []; //Inicializacion del response

        #################  Endregion  ######################

        $names = Category::pluck('name')->toArray(); //Extraccion de las categorias existentes en DB

        switch ($intent) {

            case 'getProductQuantity':

                ###################  region  #######################

                $names_min = array_map('strtolower', $names); //Conversion de todal las categorias a minusculas
                $category_part = explode(" ", $category); //Separacion del valor que vino en el parametro {category} de Dialogflow
                $category_min = array_map('strtolower', $category_part); //Formateo de todo el array del valor del parametro {category} a minusculas
                $resultado = array_intersect($names_min, $category_min); //Busqueda de coincidencias entre los array de category de DB y el de el parametro {category}
                $categoryName_NS = reset($resultado); //Conversion de la variable $resultado a string y establecimiento del puntero del arra en el primer indice
                $categoryName = ucfirst($categoryName_NS); //Formateando la palabra $categoryName_NS para que la primera letra sea mayuscula

                #################  Endregion  ######################

                if (!empty($categoryName)) {
                    $categoria = Category::where('name', $categoryName)->first(); //Busqueda de match en la DB con el parametro {category}
                    if ($categoria) {

                        //Busqueda en la tabla Product, en la columna category_id
                        //  si hay algun registro que coincida con el valor del parametro
                        //  {category}, si es asi, suma todos los registros de la columna
                        //   quantity de los productos que pertenezcan a esa categoria.
                        $total = Product::where('category_id', $categoria->id)->sum('quantity');
                        // return response()->json(['fulfillmentText' => 'Hay ' . $total . ' productos en la categoría ' . $categoryName . '.']);
                        $response = (['fulfillmentText' => 'Hay ' . $total . ' productos en la categoría ' . $categoryName . '.']);
                    } else {
                        $response = (['fulfillmentText' => 'Lo siento, no pude encontrar la categoría' . $categoryName . '.']);
                    }
                } else {

                    $names = implode(', ', $names); //Conversion del array a un string separado por ","
                    $response = [
                        'fulfillmentMessages' => [
                            ['text' => ['text' => ['Ingrese una categoría válida por favor.']]],
                            ['text' => ['text' => ['Contamos con estas categorías: ' . $names]]],
                            ['text' => ['text' => ['Recuerde SIEMPRE escribir el nombre de la categoria que quiere consultar en SINGULAR.']]],


                        ]
                    ];
                }

                #################  Endregion  ######################

                break;

            case 'Inicio':
                $names = implode(', ', $names); //Conversion del array a un string separado por ","
                $response = [
                    'fulfillmentMessages' => [
                        ['text' => ['text' => ['Hola, soy un Bot creado para ayudarte a saber cuantos productos de una categoría especifica hay, recuerda hacer preguntas como:']]],
                        ['text' => ['text' => ['Cuanto (la categoría por la que quieres preguntar) hay?']]],
                        ['text' => ['text' => ['Cuanta (la categoría por la que quieres preguntar) hay?']]],
                        ['text' => ['text' => ['Contamos con estas categorías: ' . $names]]],
                        ['text' => ['text' => ['Recuerde SIEMPRE escribir el nombre de la categoria que quiere consultar en SINGULAR.']]],


                    ]
                ];
                break;

            default:
                $response = ['fulfillmentText' => "Lo siento, no entendí tu solicitud."];
                break;
        }
        return response()->json($response);
    }




}



