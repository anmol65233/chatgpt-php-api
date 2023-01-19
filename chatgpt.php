<?php
    $sk = "sk_xxxxxxxxxx";

    // curl request for davinci Model
    function sendRequest($sk,$question){
        $ch = curl_init();
        $question = $_POST['question'];
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"model\": \"text-davinci-003\", \"prompt\": \"$question\", \"temperature\": 0, \"max_tokens\": 100}");
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = "Authorization: Bearer $sk";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $result = json_decode($result, 1);
        $answer = $result['choices'][0]['text'];
        return $answer;   
    }

    // test code
    $question = "Write your question here";
    $answer = sendRequest($sk,$question);
    echo $answer;
