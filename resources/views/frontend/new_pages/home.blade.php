@include('frontend.includes.new_header')
      
      <div class="main py-3" >
        <h2 class="text-center text-light fw-bold">
          <span class="border-bottom border-primary text-capitalize text-primary">Welcome to the official Portal of Cyber Yoddha team</span>
        </h2>
          <div class="row mx-0 align-items-start justify-content-around" style="margin-top: 100px">

            <div class="col-auto">
              <div class="card border-primary bg-transparent text-white" >
                <div class="card-body p-2">
                  <img src="https://wbcsirt.nltr.org/assets/cm.jpg" alt="">
                </div>                
              </div>
              <p class="text-center text-uppercase"><span class="fw-bold">Mamata Banerjee</span> <br><small>Hon'ble Chief Minister <br> Government of West Bengal</small></p>
            </div>
            <div class="col-auto">
              <div class="card border-primary bg-transparent text-white" >
                <div class="card-body p-2">
                  <img src="https://wbcsirt.nltr.org/assets/mic1.jpg" alt="">
                </div>
              </div>
              <p class="text-center text-uppercase"><span class="fw-bold">Dr. Partha Chatterjee</span> <br><small>Minister-in-Charge<br> Government of West Bengal</small></p>
            </div>
            <div class="col-auto">
              <div class="card border-primary bg-transparent text-white" >
                <div class="card-body p-2">
                  <img src="{{asset('assets/img/banner-2.png')}}" alt="" width="340" >
                </div>
              </div>
            </div>
            
                         
          </div>

          <div class="row mx-0 justify-content-center" style="margin-top: 100px">
            <div class="col-sm-8">
              <div class="card border-primary bg-transparent text-white ms-auto">
                <h5 class="card-header bg-primary">Who can register</h5>
                <div class="card-body text-dark">
                  <p class="card-text">
                    <ul>
                      <li>In the past few months, we have come across reports</li>
                      <li>of many data breaches in India, be it Dominos, Mobikwik</li>
                      <li>BigBasket where PII of millions of users were leaked</li>
                      <li>Reports also suggest that cyber criminals, hacktivists and threat actors from different countries are not only targeting private organizations but are also very keen to attack the Govt. sectors.</li>
                    </ul>
                  </p>
                </div>
              </div>
            </div>
          </div>

      </div>
      

      @include('frontend.includes.new_footer')