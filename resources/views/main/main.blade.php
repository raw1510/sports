@extends('main.mainheader')

  @section('title')
    PCI — Paralympic Committee of India
  @endsection

  
  @section('mainContent')
    @include('components.homepage.navbar')
    @include('components.homepage.slider')
    @include('components.homepage.about')
    @include('components.homepage.gallery')
    @include('components.homepage.contact')
    @include('components.homepage.footer')
  @endsection


@section('styling')
  <style>
    /* Minimal custom styles only where Tailwind can't help quickly */
    :root { --accent: #2563eb; }
    /* small UI niceties */
    .dropdown-menu { display: none; }
    .dropdown-open > .dropdown-menu { display: block; }
    .partner-logo { filter: grayscale(100%); transition: filter .25s ease, transform .25s ease; }
    .partner-logo:hover { filter: grayscale(0%); transform: translateY(-3px); }
    .news-card:hover, .athlete-card:hover { transform: translateY(-6px); box-shadow: 0 10px 24px rgba(0,0,0,.08); }
    /* smooth reduced-motion preference */
    @media (prefers-reduced-motion: reduce) {
      * { scroll-behavior: auto !important; }
    }
    /* small helper for visually-hidden text for screen readers */
    .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
                

  </style>
  @endsection