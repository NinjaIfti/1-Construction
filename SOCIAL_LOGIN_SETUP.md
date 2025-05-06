# Social Login Setup Guide

This guide explains how to set up social authentication with Google and LinkedIn for the 1 Contractor application.

## Required Environment Variables

Add the following environment variables to your `.env` file:

```
# Google OAuth credentials
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"

# LinkedIn OAuth credentials
LINKEDIN_CLIENT_ID=your-linkedin-client-id
LINKEDIN_CLIENT_SECRET=your-linkedin-client-secret
LINKEDIN_REDIRECT_URI="${APP_URL}/auth/linkedin/callback"
```

## Setting Up Google OAuth

1. Go to the [Google Developer Console](https://console.developers.google.com/)
2. Create a new project
3. Navigate to "APIs & Services" > "Credentials"
4. Click "Create Credentials" > "OAuth client ID"
5. Select "Web application" as the application type
6. Add your app's authorized redirect URI: `https://yourdomain.com/auth/google/callback`
7. Click "Create" and note your client ID and secret

## Setting Up LinkedIn OAuth

1. Go to the [LinkedIn Developer Portal](https://www.linkedin.com/developers/apps)
2. Click "Create App"
3. Fill in the required information about your application
4. Under "Auth" tab, add your app's authorized redirect URL: `https://yourdomain.com/auth/linkedin/callback`
5. Note your client ID and secret from the app's settings

## Verifying Setup

After setting up:

1. Visit your login page
2. Click either the "Google" or "LinkedIn" buttons
3. You should be redirected to the respective authentication page
4. After authenticating, you should be redirected back to your application and logged in

## Troubleshooting

If you encounter issues:

1. Verify your environment variables are set correctly
2. Ensure the redirect URIs match exactly what's configured in Google/LinkedIn
3. Check logs for detailed error messages
4. Verify SSL is properly set up if using HTTPS 