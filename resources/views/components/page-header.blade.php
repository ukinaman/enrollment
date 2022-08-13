{{-- @props(['id']) --}}
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <!-- <div class="page-pretitle"> -->
                    <!-- Overview -->
                <!-- </div> -->
                <h2 class="page-title">
                    {{ $title }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if ($buttonType == "add")
                        <a href="{{ route($routeName) }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Create new {{ $buttonTitle }}
                        </a>
                    @elseif($buttonType == "save")
                        <a onclick="document.getElementById('{{ $routeName }}').submit()" class="btn btn-success d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <circle cx="12" cy="14" r="2" />
                                <polyline points="14 4 14 8 8 8 8 4" />
                            </svg>
                            Save
                        </a>
                    @elseif($buttonType == 'assess')
                        <a onclick="document.getElementById('{{ $routeName }}').submit()" class="btn btn-primary d-none d-sm-inline-block">
                            Assess
                        </a>
                    @elseif ($buttonType == 'payment')
                      <a class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalDiscount">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart-discount" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <circle cx="6" cy="19" r="2" />
                          <circle cx="17" cy="19" r="2" />
                          <path d="M17 17h-11v-14h-2" />
                          <path d="M20 6l-1 7h-13" />
                          <path d="M10 10l6 -6" />
                          <circle cx="10.5" cy="4.5" r=".5" />
                          <circle cx="15.5" cy="9.5" r=".5" />
                        </svg>
                        Manage Discount
                      </a>
                      <a href="{{ route($routeName, $slot) }}" class="btn btn-success d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <rect x="3" y="5" width="18" height="14" rx="3" />
                          <line x1="3" y1="10" x2="21" y2="10" />
                          <line x1="7" y1="15" x2="7.01" y2="15" />
                          <line x1="11" y1="15" x2="13" y2="15" />
                        </svg>
                        Proceed to Payment
                      </a>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<x-modals enrollee="{{ $enrollee }}"/>