<nav class="bg-gray-800" x-data="{open:false}">
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
       
        <!-- Mobile menu button-->
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">   
          <button x-on:click="open= true" type="button" class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Abrir el menu</span> 
            <!--
                Icon when menu is closed.
                Heroicon name: outline/menu
                Menu open: "hidden", Menu closed: "block"
            -->

            <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!--
              Icon when menu is open.
              Heroicon name: outline/x
              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
          
            {{-- logotipo --}}
            <a href="/" class="flex items-center flex-shrink-0">
                       	        <img class="block w-auto h-8 lg:hidden" src="http://blogj2fotografos.test/storage/posts/LOGO.png " alt="Workflow">
			    <img class="hidden w-auto h-8 lg:block" src="http://blogj2fotografos.test/storage/posts/LOGO.png" alt="Workflow">
				  </a>

            {{-- Menu lg --}}
            <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
             {{--  <a href="#" class="px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-md" aria-current="page">Dashboard</a>--}} <a href="http://blogj2fotografos.test/" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">BLOG </a>
              @foreach ($categories as $category)
              <a href="{{ route('posts.category' , $category)}}" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">{{ $category -> name }}</a>      
              @endforeach
            </div>
          </div>
        </div>
        
        @auth
        {{-- Boton notificacion --}}
         <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          {{--  <button type="button" class="p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                <span class="sr-only">Ver notificaciones</span>
                <!-- Heroicon name: outline/bell -->
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button> --}}
  
          <!-- Profile dropdown -->
          <div class="relative ml-3" x-data="{open:false}">
            <div>
              <button x-on:click="open =true"  class="flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Abrir menú de usuario</span> 
                <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->profile_photo_url }} " alt="">
              </button>
            </div>
  
            <!--
              Dropdown menu, show/hide based on menu state.
  
              Entering: "transition ease-out duration-100"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->
            <div x-show="open" x-on:click.away="open = false" class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <!-- Active: "bg-gray-100", Not Active: "" -->
              <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Tu Perfil</a>
              
              @can('admin.home')
                <a href="{{ route('admin.home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"" role="menuitem" tabindex="-1" id="user-menu-item-1">Panel Administrativo</a> 
              @endcan
              
              <form method="POST" action="{{ route('logout') }}">
              
              @csrf
              <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="event.preventDefault();
              this.closest('form').submit();">
                  Cerrar session
              </a>
              </form>
            </div>
          </div>
        </div> 
       
        @else
        <div>
        <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Login</a>   
        <a href="{{ route('register') }}" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">registro</a>   
        </div>
        @endauth
      </div>
    </div>
   
     {{-- Mobile mobil --}}
    <div class="sm:hidden" x-show="open" x-on:click.away="open = false">
      <div class="px-2 pt-2 pb-3 space-y-1">
       {{--  <Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white">
       <a href="#" class="block px-3 py-2 text-base font-medium text-white bg-gray-900 rounded-md" aria-current="page">Dashboard</a>
       --}}  <a href="http://blogj2fotografos.test/" class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">BLOG</a>
       
         @foreach ($categories as $category)
         <a href="{{ route('posts.category' , $category)}}" class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">{{ $category -> name }}</a>   
          @endforeach
          <div class="flex space-x-4">
        </div>
   
      </div>
    </div>
  </nav>
