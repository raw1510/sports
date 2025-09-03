<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { padding: 20px; background: #f9f9f9; border-radius: 10px; }
        .header { font-size: 20px; font-weight: bold; color: #b45309; }
        .data { margin-top: 15px; }
        .data p { margin: 6px 0; }
    </style>
</head>
<body>
    <div class="container">
        <p class="header">New Inquiry Received 🚀</p>
        <p>You have a new contact inquiry from your website:</p>

        <div class="data">
            <p><strong>Name:</strong> {{ $inquiry->full_name }}</p>
            <p><strong>Age:</strong> {{ $inquiry->age }}</p>
            <p><strong>Disability Type:</strong> {{ $inquiry->disability_type }}</p>
            <p><strong>Contact Number:</strong> {{ $inquiry->contact_number }}</p>
            <p><strong>Information Request:</strong> {{ $inquiry->information_request }}</p>
        </div>

        <p style="margin-top:20px;">Please log in to your admin panel to review.</p>
    </div>
</body>
</html>
