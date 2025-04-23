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
    activeTab: 'dashboard',
    uploadDragActive: false,
    notifications: [
      { text: 'New permit request', date: 'Apr 22' },
      { text: 'Apdrest updated', date: 'Apr 21' },
      { text: 'Phonicles approved', date: 'Apr 20' }
    ],
    projectStatuses: [
      { name: 'New notifications', date: 'Apr 12', status: '' },
      { name: 'Site-Development', date: 'Apr 23', status: '' },
      { name: 'Electrical Work', date: '', status: 'awaiting' },
      { name: 'Plumbing Installation', date: '', status: 'approved' },
      { name: 'Interior Remodel', date: '', status: 'pending' },
      { name: 'Roof Replacement', date: '', status: 'awaiting' }
    ],
    dropdownOpen: false
  }" class="min-h-screen">
    <div class="flex flex-col lg:flex-row gap-6 p-4 md:p-6">
      <!-- Admin Dashboard Panel -->
      <div class="w-full lg:w-full bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-900 text-white p-4 flex justify-between items-center">
          <div class="flex items-center">
            <span class="text-red-600 text-3xl md:text-4xl font-bold">1</span>
            <div class="ml-2">
              <div class="text-lg md:text-xl font-bold">CONTRACTOR</div>
              <div class="text-xl md:text-2xl font-bold -mt-1">SOLUTIONS</div>
            </div>
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
              <a href="{{ route('login.custom') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </a>
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
                <button @click="activeTab = 'dashboard'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'dashboard' ? 'bg-blue-900' : ''">
                  <i class="fas fa-home mr-3"></i>
                  <span>Dashboard</span>
                </button>
                <button @click="activeTab = 'permits'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'permits' ? 'bg-blue-900' : ''">
                  <i class="fas fa-file-alt mr-3"></i>
                  <span>Permit Requests</span>
                </button>
                <button @click="activeTab = 'documents'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'documents' ? 'bg-blue-900' : ''">
                  <i class="fas fa-folder mr-3"></i>
                  <span>Documents</span>
                </button>
                <button @click="activeTab = 'contractors'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'contractors' ? 'bg-blue-900' : ''">
                  <i class="fas fa-users mr-3"></i>
                  <span>Contractors</span>
                </button>
                <button @click="activeTab = 'notifications'; sidebarOpen = false" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'notifications' ? 'bg-blue-900' : ''">
                  <i class="fas fa-bell mr-3"></i>
                  <span>Notifications</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Sidebar for desktop -->
          <div class="hidden lg:block w-1/5 bg-gray-900 text-white min-h-screen">
            <div class="p-4">
              <div class="flex flex-col space-y-6">
                <button @click="activeTab = 'dashboard'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'dashboard' ? 'bg-blue-900' : ''">
                  <i class="fas fa-home mr-3"></i>
                  <span>Dashboard</span>
                </button>
                <button @click="activeTab = 'permits'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'permits' ? 'bg-blue-900' : ''">
                  <i class="fas fa-file-alt mr-3"></i>
                  <span>Permit Requests</span>
                </button>
                <button @click="activeTab = 'documents'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'documents' ? 'bg-blue-900' : ''">
                  <i class="fas fa-folder mr-3"></i>
                  <span>Documents</span>
                </button>
                <button @click="activeTab = 'contractors'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'contractors' ? 'bg-blue-900' : ''">
                  <i class="fas fa-users mr-3"></i>
                  <span>Contractors</span>
                </button>
                <button @click="activeTab = 'notifications'" class="flex items-center hover:bg-gray-800 p-2 rounded-md transition" :class="activeTab === 'notifications' ? 'bg-blue-900' : ''">
                  <i class="fas fa-bell mr-3"></i>
                  <span>Notifications</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Main Content -->
          <div class="w-full lg:w-4/5 p-4 md:p-6">
            <!-- Dashboard Tab -->
            <div x-show="activeTab === 'dashboard'">
              <h2 class="text-xl md:text-2xl font-bold mb-6">Admin Dashboard</h2>
              
              <!-- Permit Requests Section -->
              <div class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="border rounded-lg p-4">
                    <h3 class="font-bold mb-4">Permit Requests</h3>
                    <div class="flex space-x-4 md:space-x-6 justify-between md:justify-start">
                      <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold">12</div>
                        <div class="text-xs md:text-sm text-gray-600">New</div>
                      </div>
                      <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold">8</div>
                        <div class="text-xs md:text-sm text-gray-600">In Review</div>
                      </div>
                      <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold">5</div>
                        <div class="text-xs md:text-sm text-gray-600">Approved</div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Upload Documents Section -->
                  <div class="border rounded-lg p-4">
                    <h3 class="font-bold mb-4">Upload Documents</h3>
                    <div 
                      class="border-2 border-dashed rounded p-4 md:p-6 flex flex-col items-center justify-center cursor-pointer transition-colors"
                      :class="uploadDragActive ? 'border-blue-500 bg-blue-50' : 'border-gray-300'"
                      @dragover.prevent="uploadDragActive = true"
                      @dragleave.prevent="uploadDragActive = false"
                      @drop.prevent="uploadDragActive = false; alert('File uploaded successfully!')"
                      @click="document.getElementById('fileUpload').click()"
                    >
                      <input type="file" id="fileUpload" class="hidden" @change="alert('File selected successfully!')">
                      <i class="fas fa-cloud-upload-alt text-2xl md:text-3xl text-gray-400 mb-2"></i>
                      <p class="text-xs md:text-sm text-gray-500 text-center">Drag and drop files here, or click to upload</p>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Contractor Directory -->
              <div class="mb-6">
                <div class="border rounded-lg p-4">
                  <h3 class="font-bold mb-4">Contractor Directory</h3>
                  <ul class="list-disc pl-5 space-y-2">
                    <li><button @click="alert('United Builders profile')" class="text-blue-600 hover:underline">United Builders</button></li>
                    <li><button @click="alert('Summel Contracting profile')" class="text-blue-600 hover:underline">Summel Contracting</button></li>
                    <li><button @click="alert('PhoLine Construction profile')" class="text-blue-600 hover:underline">PhoLine Construction</button></li>
                    <li><button @click="alert('Costcal Contractors profile')" class="text-blue-600 hover:underline">Costcal Contractors</button></li>
                    <li><button @click="alert('Golden Gate Builders profile')" class="text-blue-600 hover:underline">Golden Gate Builders</button></li>
                  </ul>
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
              
              <!-- Project Status -->
              <div>
                <h3 class="font-bold mb-4">Project Status</h3>
                <div class="space-y-3">
                  <template x-for="project in projectStatuses" :key="project.name">
                    <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer" @click="alert('Project details: ' + project.name)">
                      <div x-text="project.name"></div>
                      <div class="flex items-center">
                        <template x-if="project.date">
                          <div class="text-xs md:text-sm text-gray-600 mr-2" x-text="project.date"></div>
                        </template>
                        <template x-if="project.status === 'awaiting'">
                          <div class="text-xs md:text-sm bg-yellow-100 px-2 py-1 rounded">Awaiting</div>
                        </template>
                        <template x-if="project.status === 'approved'">
                          <div class="text-xs md:text-sm bg-green-100 px-2 py-1 rounded">Approved</div>
                        </template>
                        <template x-if="project.status === 'pending'">
                          <div class="text-xs md:text-sm bg-gray-100 px-2 py-1 rounded">Pending</div>
                        </template>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
              
              <!-- Prof Status -->
              <div class="mt-6">
                <h3 class="font-bold mb-4">Prof.Status</h3>
                <div class="space-y-2">
                  <div class="flex items-center bg-blue-50 p-2 rounded cursor-pointer" @click="alert('Site Development details')">
                    <div class="w-full">Site Development: In-Review</div>
                  </div>
                  <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer" @click="alert('Electified Work details')">
                    <div>Electified Work</div>
                    <div class="text-xs md:text-sm bg-gray-100 px-2 py-1 rounded">Pending</div>
                  </div>
                  <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer" @click="alert('Plumbing Installation details')">
                    <div>Plumbing Installation</div>
                    <div class="text-xs md:text-sm bg-gray-100 px-2 py-1 rounded">Pending</div>
                  </div>
                  <div class="flex justify-between items-center hover:bg-gray-50 p-2 rounded cursor-pointer" @click="alert('Interior Renobate details')">
                    <div>Interior Renobate</div>
                    <div class="text-xs md:text-sm bg-gray-100 px-2 py-1 rounded">Pending</div>
                  </div>
                  <div class="flex items-center bg-blue-50 p-2 rounded cursor-pointer" @click="alert('Roof Replacement details')">
                    <div>Roof Replacement</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Permit Requests Tab -->
            <div x-show="activeTab === 'permits'" class="animate-fadeIn">
              <h2 class="text-xl md:text-2xl font-bold mb-6">Permit Requests</h2>
              <div class="bg-white rounded-lg shadow p-4">
                <div class="flex flex-wrap gap-4 mb-6">
                  <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" @click="alert('Creating new permit')">
                    <i class="fas fa-plus mr-2"></i> New Permit
                  </button>
                  <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded" @click="alert('Filter applied')">
                    <i class="fas fa-filter mr-2"></i> Filter
                  </button>
                  <div class="flex-grow"></div>
                  <div class="relative">
                    <input type="text" placeholder="Search permits..." class="border rounded px-4 py-2 pl-10 w-full" @keyup.enter="alert('Searching for permits')">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                  </div>
                </div>
                
                <div class="overflow-x-auto">
                  <table class="min-w-full bg-white">
                    <thead>
                      <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Project</th>
                        <th class="py-3 px-6 text-left">Contractor</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                      <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">P-1001</td>
                        <td class="py-3 px-6">Roof Repair</td>
                        <td class="py-3 px-6">United Builders</td>
                        <td class="py-3 px-6"><span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-xs">In Review</span></td>
                        <td class="py-3 px-6">Apr 22, 2025</td>
                        <td class="py-3 px-6 text-center">
                          <div class="flex item-center justify-center gap-2">
                            <button @click="alert('View permit P-1001')" class="text-blue-500"><i class="fas fa-eye"></i></button>
                            <button @click="alert('Edit permit P-1001')" class="text-green-500"><i class="fas fa-edit"></i></button>
                            <button @click="confirm('Are you sure you want to delete this permit?') ? alert('Permit deleted') : null" class="text-red-500"><i class="fas fa-trash"></i></button>
                          </div>
                        </td>
                      </tr>
                      <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">P-1002</td>
                        <td class="py-3 px-6">Bathroom Remodel</td>
                        <td class="py-3 px-6">Summel Contracting</td>
                        <td class="py-3 px-6"><span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs">Approved</span></td>
                        <td class="py-3 px-6">Apr 20, 2025</td>
                        <td class="py-3 px-6 text-center">
                          <div class="flex item-center justify-center gap-2">
                            <button @click="alert('View permit P-1002')" class="text-blue-500"><i class="fas fa-eye"></i></button>
                            <button @click="alert('Edit permit P-1002')" class="text-green-500"><i class="fas fa-edit"></i></button>
                            <button @click="confirm('Are you sure you want to delete this permit?') ? alert('Permit deleted') : null" class="text-red-500"><i class="fas fa-trash"></i></button>
                          </div>
                        </td>
                      </tr>
                      <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">P-1003</td>
                        <td class="py-3 px-6">Kitchen Extension</td>
                        <td class="py-3 px-6">PhoLine Construction</td>
                        <td class="py-3 px-6"><span class="bg-gray-100 text-gray-800 py-1 px-3 rounded-full text-xs">Pending</span></td>
                        <td class="py-3 px-6">Apr 18, 2025</td>
                        <td class="py-3 px-6 text-center">
                          <div class="flex item-center justify-center gap-2">
                            <button @click="alert('View permit P-1003')" class="text-blue-500"><i class="fas fa-eye"></i></button>
                            <button @click="alert('Edit permit P-1003')" class="text-green-500"><i class="fas fa-edit"></i></button>
                            <button @click="confirm('Are you sure you want to delete this permit?') ? alert('Permit deleted') : null" class="text-red-500"><i class="fas fa-trash"></i></button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
                <div class="flex justify-between items-center mt-4">
                  <div class="text-sm text-gray-600">Showing 1 to 3 of 25 entries</div>
                  <div class="flex gap-2">
                    <button class="px-3 py-1 rounded border" disabled>Previous</button>
                    <button class="px-3 py-1 rounded border bg-blue-500 text-white">1</button>
                    <button class="px-3 py-1 rounded border hover:bg-gray-100" @click="alert('Page 2')">2</button>
                    <button class="px-3 py-1 rounded border hover:bg-gray-100" @click="alert('Page 3')">3</button>
                    <button class="px-3 py-1 rounded border hover:bg-gray-100" @click="alert('Next page')">Next</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Documents Tab -->
            <div x-show="activeTab === 'documents'" class="animate-fadeIn">
              <h2 class="text-xl md:text-2xl font-bold mb-6">Documents</h2>
              <div class="bg-white rounded-lg shadow p-4">
                <div class="flex flex-wrap gap-4 mb-6">
                  <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" @click="alert('Upload document dialog')">
                    <i class="fas fa-upload mr-2"></i> Upload Document
                  </button>
                  <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded" @click="alert('Creating new folder')">
                    <i class="fas fa-folder-plus mr-2"></i> New Folder
                  </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                  <div class="border rounded p-3 hover:shadow-md cursor-pointer" @click="alert('Opening Plans folder')">
                    <div class="flex items-start">
                      <i class="fas fa-folder text-3xl text-yellow-500 mr-3"></i>
                      <div>
                        <div class="font-medium">Plans</div>
                        <div class="text-xs text-gray-500">12 files</div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="border rounded p-3 hover:shadow-md cursor-pointer" @click="alert('Opening Permits folder')">
                    <div class="flex items-start">
                      <i class="fas fa-folder text-3xl text-yellow-500 mr-3"></i>
                      <div>
                        <div class="font-medium">Permits</div>
                        <div class="text-xs text-gray-500">8 files</div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="border rounded p-3 hover:shadow-md cursor-pointer" @click="alert('Opening Contracts folder')">
                    <div class="flex items-start">
                      <i class="fas fa-folder text-3xl text-yellow-500 mr-3"></i>
                      <div>
                        <div class="font-medium">Contracts</div>
                        <div class="text-xs text-gray-500">15 files</div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="border rounded p-3 hover:shadow-md cursor-pointer" @click="alert('Opening site_plan.pdf')">
                    <div class="flex items-start">
                      <i class="fas fa-file-pdf text-3xl text-red-500 mr-3"></i>
                      <div>
                        <div class="font-medium">site_plan.pdf</div>
                        <div class="text-xs text-gray-500">3.2 MB</div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="border rounded p-3 hover:shadow-md cursor-pointer" @click="alert('Opening project_timeline.xlsx')">
                    <div class="flex items-start">
                      <i class="fas fa-file-excel text-3xl text-green-500 mr-3"></i>
                      <div>
                        <div class="font-medium">project_timeline.xlsx</div>
                        <div class="text-xs text-gray-500">1.7 MB</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Contractors Tab -->
            <div x-show="activeTab === 'contractors'" class="animate-fadeIn">
              <h2 class="text-xl md:text-2xl font-bold mb-6">Contractors</h2>
              <div class="bg-white rounded-lg shadow p-4">
                <div class="flex flex-wrap gap-4 mb-6">
                  <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" @click="alert('Add new contractor')">
                    <i class="fas fa-user-plus mr-2"></i> Add Contractor
                  </button>
                  <div class="flex-grow"></div>
                  <div class="relative">
                    <input type="text" placeholder="Search contractors..." class="border rounded px-4 py-2 pl-10 w-full" @keyup.enter="alert('Searching for contractors')">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                  </div>
                </div>
                
                <div class="overflow-x-auto">
                  <table class="min-w-full bg-white">
                    <thead>
                      <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Company</th>
                        <th class="py-3 px-6 text-left">Contact</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                      <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">United Builders</td>
                        <td class="py-3 px-6">John Smith</td>
                        <td class="py-3 px-6">john@unitedbuilders.com</td>
                        <td class="py-3 px-6">(555) 123-4567</td>
                        <td class="py-3 px-6"><span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs">Active</span></td>
                        <td class="py-3 px-6 text-center">
                          <div class="flex item-center justify-center gap-2">
                            <button @click="alert('View United Builders profile')" class="text-blue-500"><i class="fas fa-eye"></i></button>
                            <button @click="alert('Edit United Builders profile')" class="text-green-500"><i class="fas fa-edit"></i></button>
                          </div>
                        </td>
                      </tr>
                      <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">Summel Contracting</td>
                        <td class="py-3 px-6">Sarah Johnson</td>
                        <td class="py-3 px-6">sarah@summel.com</td>
                        <td class="py-3 px-6">(555) 987-6543</td>
                        <td class="py-3 px-6"><span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs">Active</span></td>
                        <td class="py-3 px-6 text-center">
                          <div class="flex item-center justify-center gap-2">
                          <button @click="alert('View Summel Contracting profile')" class="text-blue-500"><i class="fas fa-eye"></i></button>
                            <button @click="alert('Edit Summel Contracting profile')" class="text-green-500"><i class="fas fa-edit"></i></button>
                          </div>
                        </td>
                      </tr>
                      <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">PhoLine Construction</td>
                        <td class="py-3 px-6">Michael Chen</td>
                        <td class="py-3 px-6">michael@pholine.com</td>
                        <td class="py-3 px-6">(555) 456-7890</td>
                        <td class="py-3 px-6"><span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs">Active</span></td>
                        <td class="py-3 px-6 text-center">
                          <div class="flex item-center justify-center gap-2">
                            <button @click="alert('View PhoLine Construction profile')" class="text-blue-500"><i class="fas fa-eye"></i></button>
                            <button @click="alert('Edit PhoLine Construction profile')" class="text-green-500"><i class="fas fa-edit"></i></button>
                          </div>
                        </td>
                      </tr>
                      <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">Costcal Contractors</td>
                        <td class="py-3 px-6">Maria Rodriguez</td>
                        <td class="py-3 px-6">maria@costcal.com</td>
                        <td class="py-3 px-6">(555) 789-0123</td>
                        <td class="py-3 px-6"><span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-xs">Under Review</span></td>
                        <td class="py-3 px-6 text-center">
                          <div class="flex item-center justify-center gap-2">
                            <button @click="alert('View Costcal Contractors profile')" class="text-blue-500"><i class="fas fa-eye"></i></button>
                            <button @click="alert('Edit Costcal Contractors profile')" class="text-green-500"><i class="fas fa-edit"></i></button>
                          </div>
                        </td>
                      </tr>
                      <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6">Golden Gate Builders</td>
                        <td class="py-3 px-6">David Wilson</td>
                        <td class="py-3 px-6">david@goldengate.com</td>
                        <td class="py-3 px-6">(555) 321-6547</td>
                        <td class="py-3 px-6"><span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs">Active</span></td>
                        <td class="py-3 px-6 text-center">
                          <div class="flex item-center justify-center gap-2">
                            <button @click="alert('View Golden Gate Builders profile')" class="text-blue-500"><i class="fas fa-eye"></i></button>
                            <button @click="alert('Edit Golden Gate Builders profile')" class="text-green-500"><i class="fas fa-edit"></i></button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <!-- Notifications Tab -->
            <div x-show="activeTab === 'notifications'" class="animate-fadeIn">
              <h2 class="text-xl md:text-2xl font-bold mb-6">Notifications</h2>
              <div class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-center mb-4">
                  <div class="font-medium">All Notifications</div>
                  <button class="text-blue-500 hover:underline text-sm" @click="alert('Marking all as read')">Mark all as read</button>
                </div>
                
                <div class="space-y-4">
                  <div class="border-l-4 border-blue-500 bg-blue-50 p-4 rounded hover:shadow-md cursor-pointer" @click="alert('Viewing permit request notification')">
                    <div class="flex justify-between items-start">
                      <div class="flex items-start">
                        <div class="bg-blue-100 p-2 rounded-full mr-3">
                          <i class="fas fa-file-alt text-blue-500"></i>
                        </div>
                        <div>
                          <div class="font-medium">New permit request</div>
                          <div class="text-sm text-gray-600">United Builders submitted a new permit request for Roof Repair project.</div>
                        </div>
                      </div>
                      <div class="text-xs text-gray-500">Apr 22, 2025</div>
                    </div>
                  </div>
                  
                  <div class="border-l-4 border-gray-300 p-4 rounded hover:shadow-md cursor-pointer" @click="alert('Viewing update notification')">
                    <div class="flex justify-between items-start">
                      <div class="flex items-start">
                        <div class="bg-gray-100 p-2 rounded-full mr-3">
                          <i class="fas fa-sync-alt text-gray-500"></i>
                        </div>
                        <div>
                          <div class="font-medium">Apdrest updated</div>
                          <div class="text-sm text-gray-600">Project information has been updated by the contractor.</div>
                        </div>
                      </div>
                      <div class="text-xs text-gray-500">Apr 21, 2025</div>
                    </div>
                  </div>
                  
                  <div class="border-l-4 border-green-500 bg-green-50 p-4 rounded hover:shadow-md cursor-pointer" @click="alert('Viewing approval notification')">
                    <div class="flex justify-between items-start">
                      <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-full mr-3">
                          <i class="fas fa-check text-green-500"></i>
                        </div>
                        <div>
                          <div class="font-medium">Phonicles approved</div>
                          <div class="text-sm text-gray-600">The permit for Phonicles project has been approved.</div>
                        </div>
                      </div>
                      <div class="text-xs text-gray-500">Apr 20, 2025</div>
                    </div>
                  </div>
                  
                  <div class="border-l-4 border-yellow-500 bg-yellow-50 p-4 rounded hover:shadow-md cursor-pointer" @click="alert('Viewing document notification')">
                    <div class="flex justify-between items-start">
                      <div class="flex items-start">
                        <div class="bg-yellow-100 p-2 rounded-full mr-3">
                          <i class="fas fa-exclamation text-yellow-500"></i>
                        </div>
                        <div>
                          <div class="font-medium">Document required</div>
                          <div class="text-sm text-gray-600">Additional documentation is required for the Site Development project.</div>
                        </div>
                      </div>
                      <div class="text-xs text-gray-500">Apr 19, 2025</div>
                    </div>
                  </div>
                  
                  <div class="border-l-4 border-gray-300 p-4 rounded hover:shadow-md cursor-pointer" @click="alert('Viewing comment notification')">
                    <div class="flex justify-between items-start">
                      <div class="flex items-start">
                        <div class="bg-gray-100 p-2 rounded-full mr-3">
                          <i class="fas fa-comment text-gray-500"></i>
                        </div>
                        <div>
                          <div class="font-medium">New comment</div>
                          <div class="text-sm text-gray-600">Sarah Johnson from Summel Contracting left a comment on the Bathroom Remodel project.</div>
                        </div>
                      </div>
                      <div class="text-xs text-gray-500">Apr 18, 2025</div>
                    </div>
                  </div>
                </div>
                
                <div class="mt-4 text-center">
                  <button class="text-blue-500 hover:underline" @click="alert('Loading more notifications')">Load more</button>
                </div>
              </div>
            </div>
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