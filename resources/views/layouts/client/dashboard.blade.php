<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contractor Solutions Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
  <div class="container mx-auto p-4">
    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
      <!-- Header -->
      <div class="bg-gray-900 text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
          <a href="/" class="flex items-center">
            <span class="text-red-600 text-4xl font-bold">1</span>
            <div class="ml-2">
              <div class="text-xl font-bold">CONTRACTOR</div>
              <div class="text-2xl font-bold -mt-1">SOLUTIONS</div>
            </div>
          </a>
        </div>
        <div class="flex items-center">
          <div class="text-right">
            <div class="text-lg font-bold">{{ auth()->user()->name }}</div>
            <div class="text-sm">{{ auth()->user()->company_name }}</div>
            @if(auth()->user()->verification_status === 'approved')
              <div class="text-xs text-green-400">Verified Account</div>
            @elseif(auth()->user()->verification_status === 'under_review')
              <div class="text-xs text-yellow-400">Under Review</div>
            @else
              <div class="text-xs text-red-400">Verification Required</div>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="mt-1">
              @csrf
              <button type="submit" class="text-xs text-red-600 hover:underline">Logout</button>
            </form>
          </div>
          <div class="ml-2 w-8 h-8 bg-gray-300 rounded-full"></div>
        </div>
      </div>

      <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-1/4 bg-gray-900 text-white">
          <div class="p-4">
            <button id="dashboard-btn" class="flex items-center w-full mb-6 p-2 rounded transition duration-300 hover:bg-blue-700">
              <i class="fas fa-home mr-3"></i>
              <span>Dashboard</span>
            </button>
            
            @if(auth()->user()->verification_status === 'approved')
              <!-- Full menu for verified contractors -->
              <button id="submit-permit-btn" class="flex items-center w-full mb-6 p-2 rounded transition duration-300 hover:bg-blue-700 bg-blue-900">
                <i class="fas fa-file-upload mr-3"></i>
                <span>Submit Permit</span>
              </button>
              <button id="messages-btn" class="flex items-center w-full mb-6 p-2 rounded transition duration-300 hover:bg-blue-700">
                <i class="fas fa-comment mr-3"></i>
                <span>Messages</span>
              </button>
              <button id="documents-btn" class="flex items-center w-full mb-6 p-2 rounded transition duration-300 hover:bg-blue-700">
                <i class="fas fa-folder mr-3"></i>
                <span>Documents</span>
              </button>
            @else
              <!-- Only verification menu for unverified contractors -->
              <button id="verification-btn" class="flex items-center w-full mb-6 p-2 rounded transition duration-300 hover:bg-blue-700 bg-blue-900">
                <i class="fas fa-id-card mr-3"></i>
                <span>Verification</span>
              </button>
            @endif
          </div>
        </div>

        <!-- Main Content Container for all content sections -->
        <div class="w-full md:w-3/4 p-6">
          @yield('content')
          
          <!-- Dashboard Content -->
          <div id="dashboard-content" class="hidden">
            <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
            
            @if(auth()->user()->verification_status !== 'approved')
              <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                <p class="font-bold">Account Verification Required</p>
                <p>To access all features, please complete the verification process.</p>
                <a href="{{ route('verification.index') }}" class="mt-2 inline-block bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">
                  Go to Verification
                </a>
              </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
              <div class="bg-blue-100 p-4 rounded shadow">
                <div class="text-xl font-bold">12</div>
                <div class="text-sm text-gray-600">Active Projects</div>
              </div>
              <div class="bg-green-100 p-4 rounded shadow">
                <div class="text-xl font-bold">5</div>
                <div class="text-sm text-gray-600">Completed Projects</div>
              </div>
              <div class="bg-yellow-100 p-4 rounded shadow">
                <div class="text-xl font-bold">3</div>
                <div class="text-sm text-gray-600">Pending Approvals</div>
              </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-4 mb-6">
              <h3 class="font-bold mb-2">Recent Activity</h3>
              <ul class="divide-y">
                <li class="py-2">Roofing permit approved - Apr 22</li>
                <li class="py-2">New message from inspector - Apr 21</li>
                <li class="py-2">Document uploaded - Apr 20</li>
                <li class="py-2">Permit status updated - Apr 19</li>
              </ul>
            </div>
          </div>

          <!-- Verification Content -->
          <div id="verification-content" class="hidden">
            <!-- Will be replaced by verification.index view -->
          </div>

          <!-- Submit Permit Content -->
          <div id="submit-permit-content" class="hidden">
            <h2 class="text-2xl font-bold mb-4">Submit a Permit</h2>
            <h3 class="text-lg font-semibold mb-6">Permit Submission Form</h3>
            
            <form>
              <div class="mb-6">
                <label class="block mb-2">Project Address</label>
                <input type="text" class="w-full border rounded p-2" placeholder="Enter project address" />
              </div>
              
              <div class="mb-6">
                <label class="block mb-2">Permit Type</label>
                <div class="relative">
                  <select class="w-full border rounded p-2 appearance-none bg-white">
                    <option>Select permit type</option>
                    <option>Roofing</option>
                    <option>Electrical</option>
                    <option>Plumbing</option>
                    <option>Construction</option>
                    <option>Renovation</option>
                  </select>
                  <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <i class="fas fa-chevron-down"></i>
                  </div>
                </div>
              </div>
              
              <div class="mb-6">
                <label class="block mb-2">Description</label>
                <textarea class="w-full border rounded p-2" rows="3" placeholder="Enter project description"></textarea>
              </div>
              
              <div class="mb-6">
                <label class="block mb-2">Upload Documents</label>
                <div class="border-2 border-dashed border-gray-300 rounded p-8 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition">
                  <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                  <p class="text-sm text-gray-500 text-center">Drag and drop files here, or click to upload</p>
                  <input type="file" class="hidden" multiple />
                </div>
              </div>
              
              <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                  <h3 class="font-bold">Messages</h3>
                  <a href="#" class="text-sm text-blue-500 hover:underline">View all messages</a>
                </div>
                <div class="border rounded p-2">
                  <div class="flex justify-between items-center border-b pb-2 mb-2">
                    <div class="text-sm text-gray-500">Apr 22</div>
                    <div class="font-medium">Please provide the site plan.</div>
                    <div class="text-sm text-gray-500">Apr 22</div>
                  </div>
                </div>
              </div>
              
              <div class="text-center">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-12 rounded transition duration-300">
                  Submit
                </button>
              </div>
            </form>
          </div>

          <!-- Messages Content -->
          <div id="messages-content" class="hidden">
            <h2 class="text-2xl font-bold mb-4">Messages</h2>
            
            <div class="flex mb-4">
              <input type="text" class="flex-grow border rounded-l p-2" placeholder="Search messages..." />
              <button class="bg-blue-500 text-white px-4 rounded-r">Search</button>
            </div>
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
              <div class="border-b p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex justify-between">
                  <span class="font-bold">City Inspector</span>
                  <span class="text-sm text-gray-500">Apr 22</span>
                </div>
                <p class="text-gray-600">Please provide the site plan for your roofing project.</p>
              </div>
              
              <div class="border-b p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex justify-between">
                  <span class="font-bold">Permit Office</span>
                  <span class="text-sm text-gray-500">Apr 21</span>
                </div>
                <p class="text-gray-600">Your permit application has been received. Please allow 3-5 business days for processing.</p>
              </div>
              
              <div class="border-b p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex justify-between">
                  <span class="font-bold">Project Manager</span>
                  <span class="text-sm text-gray-500">Apr 20</span>
                </div>
                <p class="text-gray-600">The contractors will arrive on site tomorrow morning at 8:00 AM.</p>
              </div>
              
              <div class="p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex justify-between">
                  <span class="font-bold">Account Manager</span>
                  <span class="text-sm text-gray-500">Apr 19</span>
                </div>
                <p class="text-gray-600">Welcome to Contractor Solutions! Let us know if you have any questions.</p>
              </div>
            </div>
            
            <div class="mt-4 flex">
              <textarea class="flex-grow border rounded-l p-2" placeholder="Type a new message..."></textarea>
              <button class="bg-blue-500 text-white px-4 rounded-r">Send</button>
            </div>
          </div>

          <!-- Documents Content -->
          <div id="documents-content" class="hidden">
            <h2 class="text-2xl font-bold mb-4">Documents</h2>
            
            <div class="flex justify-between mb-4">
              <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Upload New</button>
                <button class="bg-gray-300 px-4 py-2 rounded">Create Folder</button>
              </div>
              <div>
                <input type="text" class="border rounded p-2" placeholder="Search documents..." />
              </div>
            </div>
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
              <table class="min-w-full">
                <thead>
                  <tr class="bg-gray-100">
                    <th class="text-left p-4">Name</th>
                    <th class="text-left p-4">Type</th>
                    <th class="text-left p-4">Date</th>
                    <th class="text-left p-4">Size</th>
                    <th class="text-left p-4">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">Site Plan.pdf</td>
                    <td class="p-4">PDF</td>
                    <td class="p-4">Apr 22, 2025</td>
                    <td class="p-4">1.2 MB</td>
                    <td class="p-4">
                      <button class="text-blue-500 mr-2"><i class="fas fa-download"></i></button>
                      <button class="text-red-500"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                  <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">Building Permit.pdf</td>
                    <td class="p-4">PDF</td>
                    <td class="p-4">Apr 21, 2025</td>
                    <td class="p-4">3.5 MB</td>
                    <td class="p-4">
                      <button class="text-blue-500 mr-2"><i class="fas fa-download"></i></button>
                      <button class="text-red-500"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Buttons
      const dashboardBtn = document.getElementById('dashboard-btn');
      const submitPermitBtn = document.getElementById('submit-permit-btn');
      const messagesBtn = document.getElementById('messages-btn');
      const documentsBtn = document.getElementById('documents-btn');
      const verificationBtn = document.getElementById('verification-btn');
      
      // Content sections
      const dashboardContent = document.getElementById('dashboard-content');
      const submitPermitContent = document.getElementById('submit-permit-content');
      const messagesContent = document.getElementById('messages-content');
      const documentsContent = document.getElementById('documents-content');
      const verificationContent = document.getElementById('verification-content');
      
      // Hide all content sections by default
      function hideAllContent() {
        dashboardContent.classList.add('hidden');
        if (submitPermitContent) submitPermitContent.classList.add('hidden');
        if (messagesContent) messagesContent.classList.add('hidden');
        if (documentsContent) documentsContent.classList.add('hidden');
        if (verificationContent) verificationContent.classList.add('hidden');
      }
      
      // Remove active class from all buttons
      function deactivateAllButtons() {
        dashboardBtn.classList.remove('bg-blue-900');
        if (submitPermitBtn) submitPermitBtn.classList.remove('bg-blue-900');
        if (messagesBtn) messagesBtn.classList.remove('bg-blue-900');
        if (documentsBtn) documentsBtn.classList.remove('bg-blue-900');
        if (verificationBtn) verificationBtn.classList.remove('bg-blue-900');
      }
      
      // Show dashboard content by default
      // If we're on the verification page, show that content instead
      if (window.location.pathname.includes('verification')) {
        hideAllContent();
        if (verificationBtn) {
          deactivateAllButtons();
          verificationBtn.classList.add('bg-blue-900');
        }
      } else {
        hideAllContent();
        dashboardContent.classList.remove('hidden');
        deactivateAllButtons();
        dashboardBtn.classList.add('bg-blue-900');
      }
      
      // Event listeners for sidebar buttons
      dashboardBtn.addEventListener('click', function() {
        hideAllContent();
        dashboardContent.classList.remove('hidden');
        deactivateAllButtons();
        dashboardBtn.classList.add('bg-blue-900');
      });
      
      if (submitPermitBtn) {
        submitPermitBtn.addEventListener('click', function() {
          hideAllContent();
          submitPermitContent.classList.remove('hidden');
          deactivateAllButtons();
          submitPermitBtn.classList.add('bg-blue-900');
        });
      }
      
      if (messagesBtn) {
        messagesBtn.addEventListener('click', function() {
          hideAllContent();
          messagesContent.classList.remove('hidden');
          deactivateAllButtons();
          messagesBtn.classList.add('bg-blue-900');
        });
      }
      
      if (documentsBtn) {
        documentsBtn.addEventListener('click', function() {
          hideAllContent();
          documentsContent.classList.remove('hidden');
          deactivateAllButtons();
          documentsBtn.classList.add('bg-blue-900');
        });
      }
      
      if (verificationBtn) {
        verificationBtn.addEventListener('click', function() {
          window.location.href = "{{ route('verification.index') }}";
        });
      }
    });
  </script>
</body>
</html>