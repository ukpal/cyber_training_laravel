@include('frontend.includes.new_header')

     
      
      <div class="main py-3" style="min-height: 100vh">
          <div class="row mx-0 align-items-center justify-content-center" style="height: 100%">
            {{-- <div class="col-sm-4 text-center">
              <img src="{{asset('assets/img/banner-1.png')}}" alt="">
            </div> --}}
            <div class="col-sm-10">
              <div class="card border-primary mx-auto about-card" >
                <h5 class="card-header bg-primary text-white">A digital task force under West Bengal Cyber Security Incident Response Team (WB-CSIRT)</h5>
                <div class="card-body px-5 py-3" style="text-align: justify">
                  {{-- <h5 class="card-title">Special title treatment</h5> --}}
                  {{-- <div class="card-text lh-base"> --}}
                        <p class="card-text lh-lg "> Since the start of the COVID-19 pandemic, a huge number of industries have gone online, be it business or education. Though this has proven to be a boon for some, it has also resulted in loss for many. But one thing which has reached its peak during this unprecedented time is the number of Cyber Crimes across the globe. </p>
                        <hr style="border:none;margin-top:0px;background:linear-gradient(to right, rgb(0, 0, 0), rgb(0,0,0,0));height:1px">
                        <p class="card-text lh-lg"> In the past few months, we have come across reports of many data breaches in India, be it Dominos, Mobikwik or BigBasket where PII of millions of users were leaked. Reports also suggest that cyber criminals, hacktivists and threat actors from different countries are not only targeting private organizations but are also very keen to attack the Govt. sectors. At such times, it becomes very important for all organizations to improve and update their security at regular intervals to ensure a secure web experience for all stakeholders interacting with their web applications. </p>
                        <hr style="border:none;margin-top:0px;background:linear-gradient(to right, rgb(0, 0, 0), rgb(0,0,0,0));height:1px">
                        <p class="card-text lh-lg"> In the current scenario, it is felt necessary to build a digital task force team (Bengal Cyber Yoddha Team) under the aegis of West Bengal Cyber Security Incident Response Team (WB-CSIRT or State – CERT, as often referred to), Govt. of West Bengal to uphold the Cyber Security posture of the State. The Cyber Yoddha Team will be responsible for scanning &amp; testing different e-governance portals and create advisories for fixing available vulnerabilities. </p>
                  {{-- </div> --}}
                </div>
            </div>
            </div>
          </div>
      </div>


      @include('frontend.includes.new_footer')