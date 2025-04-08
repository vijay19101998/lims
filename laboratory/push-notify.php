<?php
// if there is anything to notify, then return the response with data for
// push notification else just exit the code
$webNotificationPayload['title'] = 'New Sample Received by Mohammed';
$webNotificationPayload['body'] = 'Sample Code-432456.';
$webNotificationPayload['icon'] = 'assets/images/logo2.png';
$webNotificationPayload['url'] = 'https://vividtranstech.com/lims/laboratory';
echo json_encode($webNotificationPayload);
exit();
?>