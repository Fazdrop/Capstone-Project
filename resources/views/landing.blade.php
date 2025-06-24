    @extends('layouts.public')

    @section('title', 'Beranda PT Graha Buana Cikarang - Pengembang Kota Mandiri')

    @section('content')
        <div class="space-y-12">
            <!-- Hero Section -->
            <section
                class="relative overflow-hidden rounded-3xl shadow-2xl bg-gradient-to-br from-green-700 to-emerald-900 p-8 md:p-16 text-white text-center flex flex-col items-center justify-center min-h-[450px]">
                {{-- Gambar latar belakang dengan overlay --}}
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=1600&q=80');">
                </div>
                {{-- Overlay gelap untuk meningkatkan kontras teks --}}
                <div class="absolute inset-0 bg-black opacity-40"></div> {{-- Opacity di sini adalah kuncinya, bisa disesuaikan (e.g., opacity-50, opacity-60) --}}

                <div class="relative z-10 max-w-3xl mx-auto">
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4 drop-shadow-md">
                        Membangun Masa Depan <br class="hidden md:inline"> Bersama PT Graha Buana
                    </h1>
                    <p class="text-xl md:text-2xl font-light opacity-90 mb-8">
                        Pengembang terkemuka yang membentuk lanskap perkotaan dengan inovasi dan kualitas.
                    </p>
                    <a href="#about"
                        class="inline-flex items-center justify-center px-10 py-4 rounded-full bg-white text-green-700 hover:bg-green-100 text-lg font-semibold shadow-xl transition transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-50">
                        Pelajari Lebih Lanjut
                        <i data-feather="arrow-right" class="ml-2 w-5 h-5"></i>
                    </a>
                </div>
            </section>

            <!-- About Us Section -->
            <section id="about" class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 bg-white rounded-lg shadow-md">
                <h2 class="text-3xl font-bold text-green-700 text-center mb-8">Tentang Kami</h2>
                <p class="text-gray-700 text-lg leading-relaxed max-w-3xl mx-auto">
                    PT Graha Buana Cikarang adalah pengembang properti terkemuka, berlokasi strategis di pusat pertumbuhan
                    industri dan komersial Cikarang. Kami berkomitmen menciptakan kawasan hunian, komersial, dan industri
                    yang terintegrasi, inovatif, dan berkelanjutan. Didirikan pada tahun 2010 sebagai anak perusahaan PT
                    Jababeka Tbk, kami telah menjadi pilar dalam transformasi Cikarang dengan proyek-proyek yang
                    mengedepankan fungsionalitas, estetika, dan keberlanjutan.
                </p>
            </section>

            <!-- Visi & Misi Section -->
            <section id="visi-misi" class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 bg-gray-50 rounded-lg shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                        <i data-feather="eye" class="w-10 h-10 text-green-600 mx-auto mb-4"></i>
                        <h3 class="text-2xl font-bold text-green-700 mb-2">Visi</h3>
                        <p class="text-gray-700 text-base leading-relaxed">
                            Menjadi pengembang properti terdepan di Indonesia, diakui karena inovasi berkelanjutan, standar
                            kualitas superior, dan kontribusi nyata dalam membangun masyarakat yang lebih baik.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                        <i data-feather="trending-up" class="w-10 h-10 text-green-600 mx-auto mb-4"></i>
                        <h3 class="text-2xl font-bold text-green-700 mb-2">Misi</h3>
                        <ul class="text-gray-700 text-base list-disc list-inside space-y-2">
                            <li>Mengembangkan properti yang memenuhi standar internasional.</li>
                            <li>Membangun komunitas yang dinamis dan inklusif.</li>
                            <li>Menerapkan teknologi konstruksi ramah lingkungan.</li>
                            <li>Menciptakan nilai tambah bagi pemangku kepentingan.</li>
                            <li>Meningkatkan kesejahteraan masyarakat melalui pembangunan berkelanjutan.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 bg-white rounded-lg shadow-md">
                <h2 class="text-3xl font-bold text-green-700 text-center mb-8">Hubungi Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-green-50 p-6 rounded-lg shadow text-center">
                        <i data-feather="mail" class="w-8 h-8 text-green-600 mx-auto mb-4"></i>
                        <h3 class="text-lg font-semibold text-green-700 mb-2">Email</h3>
                        <p class="text-gray-700 text-base"><a href="mailto:info@grahabuana.com"
                                class="hover:underline">info@grahabuana.com</a></p>
                        <p class="text-gray-700 text-base"><a href="mailto:residence@jababeka.com"
                                class="hover:underline">residence@jababeka.com</a></p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg shadow text-center">
                        <i data-feather="phone" class="w-8 h-8 text-green-600 mx-auto mb-4"></i>
                        <h3 class="text-lg font-semibold text-green-700 mb-2">Telepon</h3>
                        <p class="text-gray-700 text-base"><a href="tel:+62218934370" class="hover:underline">(021) 893
                                4370</a></p>
                        <p class="text-gray-700 text-base"><a href="tel:+62813185715496" class="hover:underline">0813 1857
                                15496</a></p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg shadow text-center">
                        <i data-feather="map-pin" class="w-8 h-8 text-green-600 mx-auto mb-4"></i>
                        <h3 class="text-lg font-semibold text-green-700 mb-2">Alamat</h3>
                        <p class="text-gray-700 text-base leading-relaxed">
                            Hollywood Plaza No.10-12,<br>Jl. H. Usmar Ismail, Cikarang,<br>Jawa Barat, Indonesia
                        </p>
                    </div>
                </div>
            </section>
        </div>
    @endsection
