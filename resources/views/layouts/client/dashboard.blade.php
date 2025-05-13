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
    
    /* Make the sidebar extend full height */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    .dashboard-container {
      display: flex;
      flex-direction: column;
      flex: 1;
      padding: 1rem;
      width: 95%; /* Wider container */
      max-width: 1600px; /* Much larger max width */
      margin-left: auto;
      margin-right: auto;
    }
    
    .dashboard-main {
      display: flex;
      flex-direction: column;
      flex: 1;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      background-color: white;
      border-radius: 0.5rem;
      overflow: hidden;
      width: 100%;
    }
    
    .content-wrapper {
      display: flex;
      flex: 1;
      min-height: 0;
      min-height: calc(100vh - 74px); /* subtract header height */
    }
    
    .sidebar {
      background-color: #1a202c;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      min-height: calc(100vh - 74px); /* match content-wrapper height */
      /* height: 100vh; */
      /* position: fixed; */
      /* top: 0; */
      /* left: 0; */
      /* width: 25%; */
      /* overflow-y: auto; */
      /* z-index: 10; */
    }
    
    .main-content {
      width: 75%;
      min-height: calc(100vh - 74px); /* match content-wrapper height */
    }
    
    @media (min-width: 768px) {
      .sidebar {
        width: 25%;
      }
      
      .main-content {
        width: 75%;
      }
    }
  </style>
</head>
<body class="bg-gray-100">
  <div x-data="dashboardData">
    <div class="dashboard-container container mx-auto">
      <div class="dashboard-main">
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

        <div class="content-wrapper">
          <!-- Sidebar -->
          <div class="sidebar text-white">
            <div class="p-4">
              <div class="flex flex-col space-y-6">
                <a href="{{ route('client.dashboard') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('dashboard') || request()->routeIs('client.dashboard') ? 'bg-blue-900' : '' }}">
                  <i class="fas fa-home mr-3"></i>
                  <span>Dashboard</span>
                </a>
                
                <a href="{{ route('projects.index') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('projects.*') ? 'bg-blue-900' : '' }}">
                  <i class="fas fa-project-diagram mr-3"></i>
                  <span>Projects</span>
                </a>
                
                <a href="{{ route('client.documents.index') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('client.documents.*') ? 'bg-blue-900' : '' }}">
                  <i class="fas fa-folder mr-3"></i>
                  <span>Documents</span>
                </a>
                
                <a href="{{ route('client.permits.create') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('client.permits.*') ? 'bg-blue-900' : '' }}">
                  <i class="fas fa-file-upload mr-3"></i>
                  <span>Submit Permit</span>
                </a>
                
                <a href="{{ route('client.messages.index') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('client.messages.*') ? 'bg-blue-900' : '' }}">
                  <i class="fas fa-comment mr-3"></i>
                  <span>Messages</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Main Content Container for all content sections -->
          <div class="main-content p-6">
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
            <div id="dashboard-content" class="block {{ request()->routeIs('client.messages.*') ? 'hidden' : '' }}">
              <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
              
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-100 p-4 rounded shadow">
                  <div id="active-projects-count" class="text-xl font-bold">{{ $activeProjects ?? 0 }}</div>
                  <div class="text-sm text-gray-600">Active Projects</div>
                </div>
                <div class="bg-green-100 p-4 rounded shadow">
                  <div id="completed-projects-count" class="text-xl font-bold">{{ $completedProjects ?? 0 }}</div>
                  <div class="text-sm text-gray-600">Completed Projects</div>
                </div>
                <div class="bg-yellow-100 p-4 rounded shadow">
                  <div id="pending-approvals-count" class="text-xl font-bold">{{ $pendingApprovals ?? 0 }}</div>
                  <div class="text-sm text-gray-600">Pending Approvals</div>
                </div>
              </div>
              
              <!-- Recent Messages -->
              <div class="mb-6">
                <div class="border rounded-lg overflow-hidden">
                  <div class="bg-gray-50 p-4 border-b">
                    <h3 class="font-bold">
                      Recent Messages
                      <a href="{{ route('client.messages.index') }}" class="text-sm text-blue-500 hover:underline ml-2">View All</a>
                    </h3>
                  </div>
                  
                  <div class="divide-y">
                    @if(isset($recentActivities) && count($recentActivities) > 0)
                      @php
                        // Filter activities to only show messages
                        $messageActivities = array_filter($recentActivities, function($activity) {
                          return $activity['type'] === 'message' || $activity['type'] === 'unread_message';
                        });
                        // Take only the first 5 message activities
                        $messageActivities = array_slice($messageActivities, 0, 5);
                      @endphp
                      
                      @if(count($messageActivities) > 0)
                        @foreach($messageActivities as $activity)
                          <div class="p-4 hover:bg-gray-50">
                            <a href="{{ route('client.messages.show', $activity['messageId'] ?? 0) }}" class="block">
                              <div class="flex justify-between">
                                <span class="font-medium {{ $activity['type'] === 'unread_message' ? 'text-blue-600 font-bold' : 'text-gray-800' }}">
                                  @if($activity['type'] === 'unread_message')
                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-red-500 rounded-full">New</span>
                                  @endif
                                  {{ str_replace('[UNREAD] Message: ', '', $activity['message']) }}
                                </span>
                                <span class="text-sm text-gray-500">{{ $activity['date'] }}</span>
                              </div>
                            </a>
                          </div>
                        @endforeach
                      @else
                        <div class="p-4 text-center text-gray-500">
                          No recent messages
                        </div>
                      @endif
                    @else
                      <div class="p-4 text-center text-gray-500">
                        No recent messages
                      </div>
                    @endif
                  </div>
                  
                  <div class="bg-gray-50 p-3 border-t text-center">
                    <a href="{{ route('client.messages.create') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                      <i class="fas fa-plus-circle mr-1"></i> New Message
                    </a>
                  </div>
                </div>
              </div>
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
      let messagesBtn, messagesContent, documentsBtn, documentsContent;
      
      // Get elements based on verification status
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
        if (messagesContent) messagesContent.classList.add('hidden');
        if (documentsContent) documentsContent.classList.add('hidden');
      }
      
      // Helper function to remove active class from all buttons
      function removeActiveFromButtons() {
        if (dashboardBtn) dashboardBtn.classList.remove('bg-blue-900');
        if (messagesBtn) messagesBtn.classList.remove('bg-blue-900');
        if (documentsBtn) documentsBtn.classList.remove('bg-blue-900');
      }
      
      // Show dashboard on button click
      if (dashboardBtn) {
        dashboardBtn.addEventListener('click', function() {
          // Instead of just toggling content, navigate to the dashboard page
          window.location.href = "{{ route('dashboard') }}";
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
      
      // Show documents on button click - MODIFIED TO USE LINK INSTEAD
      if (documentsBtn) {
        documentsBtn.removeAttribute('onclick'); // Remove the onclick handler
        documentsBtn.addEventListener('click', function(e) {
          e.preventDefault(); // Prevent default action
          window.location.href = "{{ route('client.documents.index') }}";
        });
      }
      
      // Show default content on page load
      let contentLoaded = false;
      
      // Check if we're on a specific page using the route segment
      const currentPath = window.location.pathname;
      
      if (currentPath.includes('/client/documents')) {
        // This is a documents page, handled by the documents views
        contentLoaded = true;
        // Don't hide content rendered by the documents views
        removeActiveFromButtons();
        if (documentsBtn) documentsBtn.classList.add('bg-blue-900');
      } else if (currentPath.includes('/client/permits/create')) {
        // This is the submit permit page
        contentLoaded = true;
        removeActiveFromButtons();
        const submitPermitBtn = document.querySelector('a[href*="client.permits.create"]');
        if (submitPermitBtn) submitPermitBtn.classList.add('bg-blue-900');
      } else if (currentPath.includes('/client/permits')) {
        // This is a permits page
        contentLoaded = true;
        // Don't hide content rendered by the permits views
        removeActiveFromButtons();
        const permitsBtn = document.querySelector('a[href*="client.permits.index"]');
        if (permitsBtn) permitsBtn.classList.add('bg-blue-900');
      } else if (currentPath.includes('/client/messages')) {
        // This is a messages page
        contentLoaded = true;
        removeActiveFromButtons();
        if (messagesBtn) messagesBtn.classList.add('bg-blue-900');
      } else if (currentPath.includes('verification')) {
        // Do nothing, the verification page will handle its own content
        contentLoaded = true;
      } else if (currentPath.includes('profile')) {
        // Do nothing, the profile page will handle its own content
        contentLoaded = true;
      } else {
        // Default to dashboard
        hideAllContent();
        removeActiveFromButtons();
        if (dashboardContent) {
          dashboardContent.classList.remove('hidden');
          if (dashboardBtn) dashboardBtn.classList.add('bg-blue-900');
        }
      }
    });
  </script>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('dashboardData', () => ({
        notifications: [],
        activeTab: 'dashboard',
        
        init() {
          console.log('Alpine.js dashboard data initialized');
          this.updateStats();
          
          // Set active tab from backend data
          @if(isset($activeSection) && $activeSection)
          this.activeTab = '{{ $activeSection }}';
          @endif
          
          // Force dashboard to be visible only if not on messages pages
          setTimeout(() => {
            const dashboardContent = document.getElementById('dashboard-content');
            if (dashboardContent && !window.location.pathname.includes('/client/messages')) {
              console.log('Making dashboard visible');
              dashboardContent.style.display = 'block';
              dashboardContent.classList.remove('hidden');
              dashboardContent.classList.add('block');
            }
          }, 500);
        },
        
        updateStats() {
          fetch('/client/api/dashboard/stats')
            .then(response => response.json())
            .then(data => {
              document.getElementById('active-projects-count').textContent = data.activeProjects;
              document.getElementById('completed-projects-count').textContent = data.completedProjects;
              document.getElementById('pending-approvals-count').textContent = data.pendingApprovals;
            })
            .catch(error => {
              console.error('Error loading dashboard stats:', error);
            });
        }
      }))
    })
  </script>

  <!-- Sidebar for mobile (collapsible) -->
  <div 
    class="lg:hidden bg-gray-900 text-white overflow-hidden transition-all duration-300"
    :class="sidebarOpen ? 'max-h-screen' : 'max-h-0'"
  >
    <div class="p-4">
      <div class="flex flex-col space-y-6">
        <a href="{{ route('client.dashboard') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('dashboard') || request()->routeIs('client.dashboard') ? 'bg-blue-900' : '' }}">
          <i class="fas fa-home mr-3"></i>
          <span>Dashboard</span>
        </a>
        
        <a href="{{ route('projects.index') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('projects.*') ? 'bg-blue-900' : '' }}">
          <i class="fas fa-project-diagram mr-3"></i>
          <span>Projects</span>
        </a>
        
        <a href="{{ route('client.documents.index') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('client.documents.*') ? 'bg-blue-900' : '' }}">
          <i class="fas fa-folder mr-3"></i>
          <span>Documents</span>
        </a>
        
        <a href="{{ route('client.permits.create') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('client.permits.*') ? 'bg-blue-900' : '' }}">
          <i class="fas fa-file-upload mr-3"></i>
          <span>Submit Permit</span>
        </a>
        
        <a href="{{ route('client.messages.index') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('client.messages.*') ? 'bg-blue-900' : '' }}">
          <i class="fas fa-comment mr-3"></i>
          <span>Messages</span>
        </a>
      </div>
    </div>
  </div>
</body>
</html>