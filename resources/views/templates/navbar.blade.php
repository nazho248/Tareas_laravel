<div class="flex flex-wrap ">
    <section class="relative mx-auto">
        <!-- navbar -->
        <nav class="flex justify-between bg-gray-900 text-white w-screen">
            <div class="px-5 xl:px-12 py-6 flex w-full items-center">
                <a class="text-3xl font-bold font-heading" href="#">
{{--
                    <img class="h-9" src="assets/images/Logo%20Universidad.png" alt="logo">
--}}
                    <img class="h-9" src="{{asset('images/Logo%20Universidad.png')}}" alt="logo">
                </a>
                <!-- Nav Links -->
                <ul class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12">
                    <li><a class="hover:text-gray-200 p-2 px-4 rounded-full bg-blue-800" href="#">Inicio</a></li>
                    <li><a class="hover:text-gray-200" href="Proyectos.html">Proyectos</a></li>
                    <li><a class="hover:text-gray-200" href="#">Estudiantes</a></li>
                    <li><a class="hover:text-gray-200" href="#">Configuración</a></li>
                </ul>
                <!-- Header Icons -->
                <div class="hidden xl:flex items-center space-x-5 items-center">

                    <a class="flex items-center hover:text-gray-200" href="#">
                        <i class='bx bx-bell text-2xl'></i>
                        <span class="flex absolute -mt-5 ml-4">
              <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500">
                </span>
              </span>
                    </a>
                    <!-- Sign In / Register      -->
                    <a class="flex items-center hover:text-gray-200" href="#">
                        <img class="h-9 w-9 rounded-full object-cover" src="{{asset('images/user.webp')}}"
                             alt="user">
                    </a>
                </div>
            </div>
            <!-- Responsive navbar -->
            {{--<a class="xl:hidden flex mr-6 items-center" href="#">
                <i class='bx bx-bell text-2xl'></i>
                <!--indicador de notificacion-->
                <span class="flex absolute -mt-5 ml-4">
          <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500">
          </span>
        </span>
            </a>--}}
            <a class="navbar-burger self-center mr-12 xl:hidden" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </a>
        </nav>

    </section>
</div>
