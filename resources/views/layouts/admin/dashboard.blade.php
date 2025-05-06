<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contractor Solutions Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100">
  <div x-data="{ 
    sidebarOpen: false,
    activeTab: '{{ str_contains(Route::currentRouteName(), "verifications") ? "admin.verifications.index" : Route::currentRouteName() }}',
    uploadDragActive: false,
    notifications: [],
    projectStatuses: [
      { name: 'New notifications', date: 'Apr 12', status: '' },
      { name: 'Site-Development', date: 'Apr 23', status: '' },
      { name: 'Electrical Work', date: '', status: 'awaiting' },
      { name: 'Plumbing Installation', date: '', status: 'approved' },
      { name: 'Interior Remodel', date: '', status: 'pending' },
      { name: 'Roof Replacement', date: '', status: 'awaiting' }
    ],
    dropdownOpen: false,
    contractors: [],
    projects: {
      counts: { pending: 0, in_progress: 0, completed: 0, total: 0 },
      recent: []
    },
    loadContractors() {
      fetch('/admin/api/dashboard/contractors')
        .then(response => response.json())
        .then(data => {
          this.contractors = data.recent || [];
        })
        .catch(error => {
          console.error('Error loading contractors:', error);
          this.contractors = [];
        });
    },
    loadProjects() {
      fetch('/admin/api/dashboard/projects')
        .then(response => response.json())
        .then(data => {
          this.projects.counts = data.counts || { pending: 0, in_progress: 0, completed: 0, total: 0 };
          this.projects.recent = data.recent || [];
        })
        .catch(error => {
          console.error('Error loading projects:', error);
        });
    },
    loadNotifications() {
      fetch('/api/notifications/recent')
        .then(response => response.json())
        .then(data => {
          this.notifications = data;
        })
        .catch(error => {
          console.error('Error loading notifications:', error);
          this.notifications = [];
        });
    }
  }" 
  x-init="loadContractors(); loadProjects(); loadNotifications()" 
  class="min-h-screen">
    <div class="flex flex-col lg:flex-row gap-6 p-4 md:p-6">
      <!-- Admin Dashboard Panel -->
      <div class="w-full lg:w-full bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-900 text-white p-4 flex justify-between items-center">
          <div class="flex items-center">
            <a href="/" class="flex items-center">
              <span class="text-red-600 text-3xl md:text-4xl font-bold">1</span>
              <div class="ml-2">
                <div class="text-lg md:text-xl font-bold">CONTRACTOR</div>
                <div class="text-xl md:text-2xl font-bold -mt-1">SOLUTIONS</div>
              </div>
            </a>
          </div>
          <div x-data="{ dropdownOpen: false }" class="relative">
            <div class="flex items-center">
              <span class="mr-2">Admin</span>
              <div @click="dropdownOpen = !dropdownOpen" class="w-8 h-8 md:w-10 md:h-10 bg-gray-300 rounded-full flex items-center justify-center cursor-pointer">
                <i class="fas fa-user text-gray-600"></i>
              </div>
            </div>

            <!-- Dropdown menu -->
            <div x-show="dropdownOpen" 
                 @click.away="dropdownOpen = false" 
                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <i class="fas fa-cog mr-2"></i> Profile Settings
              </a>
              <div class="border-t border-gray-100 my-1"></div>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                  <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- Mobile menu button -->
        <div class="lg:hidden bg-gray-900 text-white px-4 py-2">
          <button @click="sidebarOpen = !sidebarOpen" class="flex items-center text-white focus:outline-none">
            <i class="fas fa-bars mr-2"></i> Menu
          </button>
        </div>

        <div class="flex flex-col lg:flex-row">
          <!-- Sidebar for mobile (collapsible) -->
          <div 
            class="lg:hidden bg-gray-900 text-white overflow-hidden transition-all duration-300"
            :class="sidebarOpen ? 'max-h-screen' : 'max-h-0'"
          >
            <div class="p-4">
              <div class="flex flex-col space-y-6">
                <a href="{{ route('admin.dashboard') }}" @click="activeTab = 'admin.dashboard'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.dashboard' ? 'bg-blue-900' : ''">
                  <i class="fas fa-home mr-3"></i>
                  <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.projects.index') }}" @click="activeTab = 'admin.projects.index'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.projects.index' ? 'bg-blue-900' : ''">
                  <i class="fas fa-project-diagram mr-3"></i>
                  <span>Projects</span>
                </a>
                <a href="{{ route('admin.contractors.index') }}" @click="activeTab = 'contractors.index'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'contractors.index' ? 'bg-blue-900' : ''">
                  <i class="fas fa-users mr-3"></i>
                  <span>Contractors</span>
                </a>
                <a href="{{ route('admin.verifications.index') }}" @click="activeTab = 'admin.verifications.index'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.verifications.index' || activeTab.includes('verifications') ? 'bg-blue-900' : ''">
                  <i class="fas fa-check-circle mr-3"></i>
                  <span>Verifications</span>
                </a>
                <a href="{{ route('admin.invoices.index') }}" @click="activeTab = 'admin.invoices.index'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.invoices.index' ? 'bg-blue-900' : ''">
                  <i class="fas fa-file-invoice-dollar mr-3"></i>
                  <span>Invoices</span>
                </a>
                <a href="{{ route('admin.permits.index') }}" @click="activeTab = 'admin.permits.index'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.permits.index' ? 'bg-blue-900' : ''">
                  <i class="fas fa-file-alt mr-3"></i>
                  <span>Permits</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Sidebar for desktop -->
          <div class="hidden lg:block w-1/5 bg-gray-900 text-white min-h-screen">
            <div class="p-4">
              <div class="flex flex-col space-y-6">
                <a href="{{ route('admin.dashboard') }}" @click="activeTab = 'admin.dashboard'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.dashboard' ? 'bg-blue-900' : ''">
                  <i class="fas fa-home mr-3"></i>
                  <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.projects.index') }}" @click="activeTab = 'admin.projects.index'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.projects.index' ? 'bg-blue-900' : ''">
                  <i class="fas fa-project-diagram mr-3"></i>
                  <span>Projects</span>
                </a>
                <a href="{{ route('admin.contractors.index') }}" @click="activeTab = 'contractors.index'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'contractors.index' ? 'bg-blue-900' : ''">
                  <i class="fas fa-users mr-3"></i>
                  <span>Contractors</span>
                </a>
                <a href="{{ route('admin.verifications.index') }}" @click="activeTab = 'admin.verifications.index'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.verifications.index' || activeTab.includes('verifications') ? 'bg-blue-900' : ''">
                  <i class="fas fa-check-circle mr-3"></i>
                  <span>Verifications</span>
                </a>
                <a href="{{ route('admin.invoices.index') }}" @click="activeTab = 'admin.invoices.index'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.invoices.index' ? 'bg-blue-900' : ''">
                  <i class="fas fa-file-invoice-dollar mr-3"></i>
                  <span>Invoices</span>
                </a>
                <a href="{{ route('admin.permits.index') }}" @click="activeTab = 'admin.permits.index'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'admin.permits.index' ? 'bg-blue-900' : ''">
                  <i class="fas fa-file-alt mr-3"></i>
                  <span>Permits</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Main Content -->
          <div class="w-full lg:w-4/5 p-4 md:p-6">
            @yield('content')
            
            @if(Route::currentRouteName() == 'admin.dashboard')
            <!-- Dashboard Tab -->
            <div x-show="activeTab === 'admin.dashboard'">
              <h2 class="text-xl md:text-2xl font-bold mb-6">Admin Dashboard</h2>
              
              <!-- Projects Section -->
              <div class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="border rounded-lg p-4">
                    <h3 class="font-bold mb-4">Projects Overview</h3>
                    <div class="flex space-x-4 md:space-x-6 justify-between md:justify-start">
                      <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold" x-text="projects.counts.pending">0</div>
                        <div class="text-xs md:text-sm text-gray-600">Pending</div>
                      </div>
                      <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold" x-text="projects.counts.in_progress">0</div>
                        <div class="text-xs md:text-sm text-gray-600">In Progress</div>
                      </div>
                      <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold" x-text="projects.counts.completed">0</div>
                        <div class="text-xs md:text-sm text-gray-600">Completed</div>
                      </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                      <a href="{{ route('admin.projects.index') }}" class="text-sm text-blue-600 hover:text-blue-900">View All Projects</a>
                    </div>
                  </div>
                  
                  <!-- Recent Projects -->
                  <div class="border rounded-lg p-4">
                    <h3 class="font-bold mb-4">
                      Recent Projects
                      <a href="{{ route('admin.projects.index') }}" class="text-sm text-blue-500 hover:underline ml-2">View All</a>
                    </h3>
                    <div class="space-y-2">
                      <template x-for="project in projects.recent" :key="project.id">
                        <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                          <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                              <i class="fas fa-project-diagram text-gray-500"></i>
                            </div>
                            <div>
                              <div x-text="project.name" class="font-medium"></div>
                              <div class="text-xs text-gray-500" x-text="project.contractor && project.contractor.company_name ? project.contractor.company_name : 'No Contractor'"></div>
                            </div>
                          </div>
                          <a :href="'/admin/projects/' + project.id" class="text-blue-500 hover:underline">
                            <i class="fas fa-eye"></i>
                          </a>
                        </div>
                      </template>
                      
                      <div x-show="projects.recent.length === 0" class="text-center py-4 text-gray-500">
                        No recent projects
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Contractor Directory -->
              <div class="mb-6">
                <div class="border rounded-lg p-4">
                  <h3 class="font-bold mb-4">
                    Contractor Directory
                    <a href="{{ route('admin.contractors.index') }}" class="text-sm text-blue-500 hover:underline ml-2">View All</a>
                  </h3>
                  <div class="space-y-2">
                    <template x-for="contractor in contractors" :key="contractor.id">
                      <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded">
                        <div class="flex items-center">
                          <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-building text-gray-500"></i>
                          </div>
                          <div>
                            <div x-text="contractor.company_name" class="font-medium"></div>
                            <div x-text="contractor.name" class="text-xs text-gray-500"></div>
                          </div>
                        </div>
                        <a :href="'/admin/contractors/' + contractor.id" class="text-blue-500 hover:underline">
                          <i class="fas fa-eye"></i>
                        </a>
                      </div>
                    </template>
                    
                    <div x-show="contractors.length === 0" class="text-center py-4 text-gray-500">
                      No contractors found
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Notifications Section -->
              <div class="mb-6">
                <div class="border rounded-lg p-4">
                  <h3 class="font-bold mb-4">Notifications</h3>
                  <div class="space-y-2">
                    <template x-for="notification in notifications" :key="notification.text">
                      <div class="flex justify-between hover:bg-gray-50 p-2 rounded cursor-pointer" @click="alert('Viewing notification: ' + notification.text)">
                        <div x-text="notification.text"></div>
                        <div class="text-xs md:text-sm text-gray-600" x-text="notification.date"></div>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Animated styles -->
  <style>
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    .animate-fadeIn {
      animation: fadeIn 0.3s ease-in-out;
    }
  </style>
</body>
</html>