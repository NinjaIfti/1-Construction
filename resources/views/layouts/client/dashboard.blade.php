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
                
                <a href="{{ route('client.permits.index') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('client.permits.*') ? 'bg-blue-900' : '' }}">
                  <i class="fas fa-file-alt mr-3"></i>
                  <span>Permits</span>
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
            
            @if(request()->routeIs('client.dashboard'))
              @include('layouts.client._dashboard_content')
            @else
              @yield('content')
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add any JavaScript functionality for the layout here
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
        
        <a href="{{ route('client.permits.index') }}" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition {{ request()->routeIs('client.permits.*') ? 'bg-blue-900' : '' }}">
          <i class="fas fa-file-alt mr-3"></i>
          <span>Permits</span>
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