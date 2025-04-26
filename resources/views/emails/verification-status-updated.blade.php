<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid #dee2e6;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 15px 20px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0d6efd;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 20px;
        }
        .alert-success {
            padding: 15px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .alert-warning {
            padding: 15px;
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contractor Verification Update</h1>
        </div>
        
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            
            @if($user->is_verified)
                <div class="alert-success">
                    <p><strong>Congratulations!</strong> Your contractor verification has been approved.</p>
                </div>
                
                <p>Your account has been successfully verified. You now have full access to all contractor features on our platform.</p>
                
                <p>You can now start bidding on projects, accessing exclusive contractor resources, and growing your business with us.</p>
                
                @if($user->verification_feedback)
                    <p><strong>Admin Feedback:</strong></p>
                    <p>{{ $user->verification_feedback }}</p>
                @endif
                
                <a href="{{ url('/contractor/dashboard') }}" class="button">Go to Your Dashboard</a>
            @else
                @if($user->verification_rejected_at)
                    <div class="alert-warning">
                        <p><strong>Update on Your Verification:</strong> Your verification has not been approved at this time.</p>
                    </div>
                    
                    <p>We've reviewed your submission and unfortunately, we are unable to verify your contractor account at this time.</p>
                    
                    @if($user->verification_feedback)
                        <p><strong>Reason:</strong></p>
                        <p>{{ $user->verification_feedback }}</p>
                    @endif
                    
                    <p>You may address these issues and resubmit your verification documents.</p>
                    
                    <a href="{{ url('/verification') }}" class="button">Update Verification Documents</a>
                @else
                    <div class="alert-warning">
                        <p><strong>Update on Your Verification:</strong> Your verification status has been updated.</p>
                    </div>
                    
                    <p>There has been an update to your verification status. Please log in to view the details.</p>
                    
                    <a href="{{ url('/verification') }}" class="button">Check Verification Status</a>
                @endif
            @endif
            
            <p>If you have any questions, please contact our support team.</p>
            
            <p>Thank you,<br>
            The Construction Platform Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Construction Platform. All rights reserved.</p>
            <p>This is an automated email, please do not reply directly to this message.</p>
        </div>
    </div>
</body>
</html> 