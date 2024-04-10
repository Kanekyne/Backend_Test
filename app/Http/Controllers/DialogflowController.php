<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;

class DialogflowController extends Controller
{

    public function webhook(Request $request)
    {
        // Recibir el texto de la solicitud de Dialogflow
        $text = $request->input('queryResult.queryText');

        // Enviar la solicitud a Dialogflow para obtener una respuesta
        $response = $this->detectIntentText($text);

        // Devolver la respuesta a Dialogflow
        return response()->json([
            'fulfillmentText' => $response
        ]);
    }

    private function detectIntentText($text)
    {
        $projectId = env('DIALOGFLOW_PROJECT_ID');
        $languageCode = env('DIALOGFLOW_LANGUAGE_CODE');
        $credentials = json_decode(file_get_contents(env('GOOGLE_APPLICATION_CREDENTIALS')), true);

        // Crear una instancia de SessionsClient
        $sessionsClient = new SessionsClient([
            'credentials' => $credentials
        ]);

        // Crear una sesión
        $session = $sessionsClient->sessionName($projectId, uniqid());

        // Crear una consulta de entrada de texto
        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);

        // Crear una consulta de entrada
        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        // Enviar la consulta a Dialogflow
        $response = $sessionsClient->detectIntent($session, $queryInput);

        // Obtener la respuesta de Dialogflow
        $queryResult = $response->getQueryResult();
        $fulfillmentText = $queryResult->getFulfillmentText();

        // Cerrar la sesión
        $sessionsClient->close();

        return $fulfillmentText;
    }

}
