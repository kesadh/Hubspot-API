// Form GUID
        $formGuid = 'XXXXX-XXXXX-XXXXX-XXXX-XXXX';

        // Portal ID
        $portalId = '1234567';

        $url = "https://api.hsforms.com/submissions/v3/integration/submit/{$portalId}/{$formGuid}";

        $data = [
            'fields' => [
                [
                    'name' => 'email',
                    'value' => $email
                ],
                [
                    'name' => 'utm_campaign',
                    'value' => $utm_campaign
                ],
                [
                    'name' => 'utm_content',
                    'value' => $utm_content
                ],
                [
                    'name' => 'utm_medium',
                    'value' => $utm_medium
                ],
                [
                    'name' => 'utm_source',
                    'value' => $utm_source
                ],
                [
                    'name' => 'utm_term',
                    'value' => $utm_term
                ]
            ],
            'context' => [
                'pageUri' => $current_url,
                'pageName' => $page_title
            ]
        ];

        $jsonData = json_encode($data);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            echo 'HTTP Response Code: ' . $httpCode . '<br>';
            
            echo 'Response Body: ' . $response . '<br>';
        }

        curl_close($ch);

            
    }
