<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
</head>
<body>
    <h1>Thông tin liên hệ</h1>
    <p><strong>Tên:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Tiêu đề:</strong> {{ $data['title'] }}</p>
    <p><strong>Nội dung:</strong> {{ $data['message'] }}</p>
</body>
</html>
