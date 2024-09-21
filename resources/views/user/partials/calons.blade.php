    <div class="container">
        <div class="row justify-content-around">
            @foreach ($calons as $c)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="/ppdb/{{ $c->id }}" class="col-12 inbox-left-sd btn border-{{ unit($c->gelnya->unit_id) }}" style="border-style: solid; border-width: 1px; text-align: left !important">
                    <div class="breadcomb-wp" style="padding: 0 !important">
                        <div class="breadcomb-icon">
                            <i class="fa-solid fa-user color-{{ unit($c->gelnya->unit_id) }} border-{{ unit($c->gelnya->unit_id) }}"></i>
                        </div>
                        <div class="breadcomb-ctn">
                            <h3>{{ $c->uruts }}</h3>
                            <p style="font-size: 110%">{{ $c->name }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
