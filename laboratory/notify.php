<!DOCTYPE html>
<html>
<head>
<title>Web Push Notifications in PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
    crossorigin="anonymous"></script>
</head>
<body>
    <div class="phppot-container">
        <h1>Web Push Notification using PHP in a Browser</h1>
        <p>This example shows a web push notification from PHP on
            browser automatically every 10 seconds. The notification
            also closes automatically just after 5 seconds.</p>
    </div>
    <script>

    // enable this if you want to make only one call and not repeated calls automatically
    // pushNotify();

    // following makes an AJAX call to PHP to get notification every 10 secs
    // setInterval(function(){pushNotify();}, 10000);
    pushNotify();
    


    </script>
</body>
</html>