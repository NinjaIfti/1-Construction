<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contractor Solutions Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    .dropdown {
      position: relative;
      display: inline-block;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      border-radius: 0.25rem;
    }
    .dropdown-content a, .dropdown-content button {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
      width: 100%;
    }
    .dropdown-content a:hover, .dropdown-content button:hover {
      background-color: #f1f1f1;
    }
    .dropdown:hover .dropdown-content {
      display: block;
    }
  </style>
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
          </div>
          <div class="ml-2 dropdown">
            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center cursor-pointer">
              <i class="fas fa-user"></i>
            </div>
            <div class="dropdown-content">
              <a href="{{ route('profile.index') }}" class="flex items-center">
                <i class="fas fa-user-cog mr-2"></i> Profile Settings
              </a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center text-red-600">
                  <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
              </form>
            </div>
          </div>
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
          <!-- Flash Messages -->
          @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
              <p>{{ session('success') }}</p>
            </div>
          @endif

          @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
              <p>{{ session('error') }}</p>
            </div>
          @endif
          
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
                <div class="text-xl font-bold">{{ $activeProjects ?? 0 }}</div>
                <div class="text-sm text-gray-600">Active Projects</div>
              </div>
              <div class="bg-green-100 p-4 rounded shadow">
                <div class="text-xl font-bold">{{ $completedProjects ?? 0 }}</div>
                <div class="text-sm text-gray-600">Completed Projects</div>
              </div>
              <div class="bg-yellow-100 p-4 rounded shadow">
                <div class="text-xl font-bold">{{ $pendingApprovals ?? 0 }}</div>
                <div class="text-sm text-gray-600">Pending Approvals</div>
              </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-4 mb-6">
              <h3 class="font-bold mb-2">Recent Activity</h3>
              <ul class="divide-y">
                @forelse($recentActivities ?? [] as $activity)
                  <li class="py-2">{{ $activity['message'] }} - {{ $activity['date'] }}</li>
                @empty
                  <li class="py-2 text-gray-500">No recent activities</li>
                @endforelse
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
            
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4">
              <div class="p-3 border-b bg-gray-50 flex items-center">
                <i class="fas fa-folder-open text-yellow-500 mr-2"></i>
                <span class="font-bold">Roofing Permits</span>
              </div>
              
              <div class="p-4 border-b hover:bg-gray-50 cursor-pointer flex items-center">
                <i class="fas fa-file-pdf text-red-500 mr-3"></i>
                <div class="flex-grow">
                  <div class="font-medium">Site Plan.pdf</div>
                  <div class="text-sm text-gray-500">Added Apr 22</div>
                </div>
                <div class="flex space-x-2">
                  <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-download"></i></button>
                  <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-eye"></i></button>
                  <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash-alt"></i></button>
                </div>
              </div>
              
              <div class="p-4 border-b hover:bg-gray-50 cursor-pointer flex items-center">
                <i class="fas fa-file-image text-green-500 mr-3"></i>
                <div class="flex-grow">
                  <div class="font-medium">Property Photo.jpg</div>
                  <div class="text-sm text-gray-500">Added Apr 21</div>
                </div>
                <div class="flex space-x-2">
                  <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-download"></i></button>
                  <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-eye"></i></button>
                  <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash-alt"></i></button>
                </div>
              </div>
              
              <div class="p-4 hover:bg-gray-50 cursor-pointer flex items-center">
                <i class="fas fa-file-contract text-blue-500 mr-3"></i>
                <div class="flex-grow">
                  <div class="font-medium">Contract.pdf</div>
                  <div class="text-sm text-gray-500">Added Apr 20</div>
                </div>
                <div class="flex space-x-2">
                  <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-download"></i></button>
                  <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-eye"></i></button>
                  <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash-alt"></i></button>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
              <div class="p-3 border-b bg-gray-50 flex items-center">
                <i class="fas fa-folder-open text-yellow-500 mr-2"></i>
                <span class="font-bold">Renovation Documents</span>
              </div>
              
              <div class="p-4 border-b hover:bg-gray-50 cursor-pointer flex items-center">
                <i class="fas fa-file-alt text-gray-500 mr-3"></i>
                <div class="flex-grow">
                  <div class="font-medium">Design Spec.docx</div>
                  <div class="text-sm text-gray-500">Added Apr 19</div>
                </div>
                <div class="flex space-x-2">
                  <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-download"></i></button>
                  <button class="text-gray-500 hover:text-gray-700"><i class="fas fa-eye"></i></button>
                  <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash-alt"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Cache DOM elements
      const dashboardBtn = document.getElementById('dashboard-btn');
      const dashboardContent = document.getElementById('dashboard-content');
      let verificationBtn, verificationContent, submitPermitBtn, submitPermitContent, messagesBtn, messagesContent, documentsBtn, documentsContent;
      
      // Get elements based on verification status
      if (document.getElementById('verification-btn')) {
        verificationBtn = document.getElementById('verification-btn');
        verificationContent = document.getElementById('verification-content');
      }
      
      if (document.getElementById('submit-permit-btn')) {
        submitPermitBtn = document.getElementById('submit-permit-btn');
        submitPermitContent = document.getElementById('submit-permit-content');
      }
      
      if (document.getElementById('messages-btn')) {
        messagesBtn = document.getElementById('messages-btn');
        messagesContent = document.getElementById('messages-content');
      }
      
      if (document.getElementById('documents-btn')) {
        documentsBtn = document.getElementById('documents-btn');
        documentsContent = document.getElementById('documents-content');
      }
      
      // Helper function to hide all content sections
      function hideAllContent() {
        // Use Array.from to convert NodeList to Array for forEach
        Array.from(document.querySelectorAll('.w-full.md\\:w-3\\/4.p-6 > div')).forEach(section => {
          if (!section.classList.contains('hidden') && !section.hasAttribute('id')) {
            section.classList.add('hidden');
          }
        });
        
        if (dashboardContent) dashboardContent.classList.add('hidden');
        if (verificationContent) verificationContent.classList.add('hidden');
        if (submitPermitContent) submitPermitContent.classList.add('hidden');
        if (messagesContent) messagesContent.classList.add('hidden');
        if (documentsContent) documentsContent.classList.add('hidden');
      }
      
      // Helper function to remove active class from all buttons
      function removeActiveFromButtons() {
        if (dashboardBtn) dashboardBtn.classList.remove('bg-blue-900');
        if (verificationBtn) verificationBtn.classList.remove('bg-blue-900');
        if (submitPermitBtn) submitPermitBtn.classList.remove('bg-blue-900');
        if (messagesBtn) messagesBtn.classList.remove('bg-blue-900');
        if (documentsBtn) documentsBtn.classList.remove('bg-blue-900');
      }
      
      // Show dashboard on button click
      if (dashboardBtn) {
        dashboardBtn.addEventListener('click', function() {
          hideAllContent();
          removeActiveFromButtons();
          dashboardContent.classList.remove('hidden');
          dashboardBtn.classList.add('bg-blue-900');
        });
      }
      
      // Show verification on button click
      if (verificationBtn) {
        verificationBtn.addEventListener('click', function() {
          // Redirect to verification page
          window.location.href = "{{ route('verification.index') }}";
        });
      }
      
      // Show submit permit on button click
      if (submitPermitBtn) {
        submitPermitBtn.addEventListener('click', function() {
          hideAllContent();
          removeActiveFromButtons();
          submitPermitContent.classList.remove('hidden');
          submitPermitBtn.classList.add('bg-blue-900');
        });
      }
      
      // Show messages on button click
      if (messagesBtn) {
        messagesBtn.addEventListener('click', function() {
          hideAllContent();
          removeActiveFromButtons();
          messagesContent.classList.remove('hidden');
          messagesBtn.classList.add('bg-blue-900');
        });
      }
      
      // Show documents on button click
      if (documentsBtn) {
        documentsBtn.addEventListener('click', function() {
          hideAllContent();
          removeActiveFromButtons();
          documentsContent.classList.remove('hidden');
          documentsBtn.classList.add('bg-blue-900');
        });
      }
      
      // Show default content on page load
      let contentLoaded = false;
      
      // Check if we're on a specific page using the route segment
      const currentPath = window.location.pathname;
      
      if (currentPath.includes('verification')) {
        // Do nothing, the verification page will handle its own content
        contentLoaded = true;
      } else if (currentPath.includes('profile')) {
        // Do nothing, the profile page will handle its own content
        contentLoaded = true;
      } else if (!contentLoaded) {
        // Default to dashboard
        hideAllContent();
        removeActiveFromButtons();
        if (dashboardContent) {
          dashboardContent.classList.remove('hidden');
          dashboardBtn.classList.add('bg-blue-900');
        }
      }
    });
  </script>
</body>
</html>