<?php
// Assuming this is your PHP file, e.g., app.php
function transcribeAudio($audioFile) {
    $url = 'https://api.openai.com/v1/audio/transcriptions';
    $apiKey = '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';

    $headers = [
        'Authorization: Bearer ' . $apiKey,
    ];

    $postData = [
        'file' => new CURLFile($audioFile),
        'model' => 'whisper-1',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Usage example:
$audioFile = '/path/to/audio/file.wav';
$response = transcribeAudio($audioFile);
var_dump($response);

function sendToSantaClausVoice($text)
{
    $data = array(
        'text' => $text,
        'voice' => 's3://voice-cloning-zero-shot/2d9e57f1-288a-4920-a0be-503d7cbec19e/sanata/manifest.json',
        'quality' => 'medium',
        'output_format' => 'mp3',
        'speed' => 1,
        'sample_rate' => 24000
    );

    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n" .
                "AUTHORIZATION: 4b4f23a0dc6d4344997b45249361155f\r\n" .
                "X-USER-ID: 86PDqTl293fcJEclw583R7JtWZO2\r\n" .
                "accept: text/event-stream\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        )
    );

    $context = stream_context_create($options);
    $response = file_get_contents('https://play.ht/api/v2/tts', false, $context);

    if ($response === false) {
        echo 'Error communicating with Play.ht API';
    } else {
        $data = json_decode($response, true);
        var_dump($data); // Example: Print the response data
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you want to handle a POST request
    $text = $_POST['text'] ?? '';

    if (!empty($text)) {
        sendToSantaClausVoice($text);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>My App</title>
</head>

<body>
    <div class="App">
        <header class="App-header">
            <button onclick="startRecording()" style="font-size: 20px; margin-bottom: 10px;">Start Recording</button>
            <br />
            <br />
            <button onclick="stopRecording()" style="font-size: 20px;">Stop Recording</button>
        </header>
    </div>

    <script>
        let mediaRecorder;
        let chunks = [];

        function startRecording() {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then((stream) => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.start();

                    mediaRecorder.addEventListener('dataavailable', (event) => {
                        chunks.push(event.data);
                    });
                })
                .catch((error) => {
                    console.error('Error accessing microphone:', error);
                });
        }
        function stopRecording() {
    if (mediaRecorder && mediaRecorder.state !== 'inactive') {
        mediaRecorder.stop();

        mediaRecorder.addEventListener('stop', () => {
            const audioBlob = new Blob(chunks, { type: 'audio/webm' });
            const audioFormData = new FormData();
            audioFormData.append('audio', audioBlob);

            // Send the recorded audio to the server using AJAX or fetch
            fetch('santa.php', {
                method: 'POST',
                body: audioFormData
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server
                console.log(data);
            })
            .catch(error => {
                console.error('Error sending audio to the server:', error);
            });

            // Reset the recording state
            chunks = [];
            mediaRecorder = null;
        });
    }
}
    </script>
</body>

</html>