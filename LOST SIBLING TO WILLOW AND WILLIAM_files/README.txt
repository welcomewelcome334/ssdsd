LOST SIBLING TO WILLOW AND WILLIAM - PHP Backend
================================================

To run this application:

1. You need PHP installed on your system (version 7.0+ recommended)
2. Place all files in the same directory
3. Start a PHP server in that directory:
   php -S localhost:8000
4. Open your browser to http://localhost:8000

How it works:
- Enter "MA5H" on the main page to proceed to identity verification
- Enter your Roblox User ID on the identity page
- The system will generate a UUID for you and store it
- You will see the "Lost Sibling Has Been Found" page with your access token (UUID)
- To use your UUID later, enter your Roblox User ID on the main page instead of MA5H

Files:
- index.html - Main entry point
- identity-page.html - Identity input page
- script.js - Client-side logic
- verify.php - Handles /verify endpoint (checks MA5H and Roblox IDs)
- identity-check.php - Handles /identity-check endpoint (generates and stores UUID)
- secret-content.php - Handles /secret-content endpoint (displays success page with UUID)
- data.json - Automatically generated storage for UUID mappings
- assets/ - Contains wolf.png image
- lost sibling has been found stuff/ - Contains the success page reference

Notes:
- The UUID is a version 4 RFC 4122 compliant UUID
- Data is stored in data.json in the same directory
- The Roblox game link points to: https://www.roblox.com/games/4947755371/