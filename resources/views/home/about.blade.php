@extends('template.HomeView', ['title' => 'About SPMI'])

@section('content')
    <!-- Main Content Section -->
    <main id="main">
        <section id="introduction" class="text-center">
            <h2 class="fw-bold">Tentang SPMI</h2>
            <p class="mt-12">Sistem Penjamin Mutu Internal (SPMI) merupakan sistem informasi yang dibangun agar dapat
                mendukung
                pengukuran/penjamin mutu internal IAIN.</p>
        </section>

        <section id="goal" class="text-center">
            <h2 class="fw-bold">Tujuan</h2>
            <p>Dengan adanyan sistem informasi ini (<span class="fw-bold">SPMI</span>) diharapkan agar dapat melakukan
                manajemen yang komprehensif dan akurat.
            </p>
        </section>
    </main>
@endsection
