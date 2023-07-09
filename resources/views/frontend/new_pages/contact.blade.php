@include('frontend.includes.new_header')

     
      
      <div class="main py-3" style="min-height: 100vh">

          <div class="row mx-0  justify-content-center" style="height: 100%">
            {{-- <div class="col-sm-4 text-center">
              <img src="{{asset('assets/img/banner-1.png')}}" alt="">
            </div> --}}
            <div class="col-sm-10">
              <div class="card border-primary mx-auto about-card" >
                <h5 class="card-header bg-primary text-white">Contact Information</h5>
                <div class="card-body ">
                 <div class="row mx-0">
                    <div class="col-sm-8">
                        <p class="fs-3 border-bottom">Secretariat</p>
                        <p><strong>Address:</strong></p>
                        <p><strong>Cyber Security Centre of Excellence (CS-CoE)</strong></p>
                        <p>Webel Bhavan, Ground Floor, Block - EP & GP, Sector – V, Bidhannagar<br>
                        Salt Lake, Kolkata - 700 091</p>
                        <p class="mb-5"><strong>Email:</strong> <a href="mailto:director.csirt@wb.gov.in" class="text-decoration-none">director[dot]csirt[at]wb[dot]gov[dot]in</a></p>
                        <hr>
                        <p class="fs-3 border-bottom mt-5">SIA & SLNA</p>
                        <p><strong>Address:</strong></p>
                        <p><strong>Society for Natural Language Technology Research (SNLTR)</strong></p>
                        <p>Monibhandar (6th floor, Block C and D)<br>
                        Premise of Webel Bhavan<br>
                        Block - EP & GP<br>
                        Sector-V, Salt Lake<br>
                        Kolkata - 700 091</p>
                        <p><strong>Email:</strong> <a href="mailto:nltr@wb.gov.in" class="text-decoration-none">nltr[at]wb[dot]gov[dot]in</a></p>
                        <p><strong>Phone:</strong> <a href="tel:tel:+91913323572533" class="text-decoration-none">91 33 2357-2533</a></p>
                    </div>
                    <div class="col-sm-4">
                        <img src="{{asset('assets/img/banner-2.png')}}" alt="" width="350">
                    </div>
                 </div>
                </div>
            </div>
            </div>
          </div>
      </div>


      @include('frontend.includes.new_footer')