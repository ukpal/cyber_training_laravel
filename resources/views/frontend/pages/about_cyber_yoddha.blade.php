@extends('frontend.layouts.default')
@section('page_title', 'About Cyber Yoddha')
@section('content')

<main class="site-content" style="background: linear-gradient(90deg, rgb(144, 157, 161) 0%, rgba(250, 250, 250, 0.8) 50%, rgb(144, 157, 161) 100%); padding-top: 5px; display: block;">
    <section class="container" id="Home" style="margin-top:50px;min-height:75vh">
        <div id="main-text">
            <div style="display:flex">
                <h1 style="color:rgb(6,43,118)">WEST BENGAL CYBER YODDHA TEAM &nbsp;</h1>
                <a href="#" title="External link to West Bengal Cyber Yoddha Team official portal">
                    <i class="fas fa-lg fa-external-link-alt"></i>
                </a>
            </div>
            <h5 style="color:rgb(6,43,118);font-family:Lato">A digital task force under West Bengal Cyber Security Incident Response Team (WB-CSIRT)</h5>
            <hr style="border:none;margin-top:0px;background:linear-gradient(to right, orange, rgb(0,0,0,0));height:1px">
            <div class="row">
                <div class="col-sm-12 align-self-center" style="text-align:justify;text-justify:inter-word">
                    <p> Since the start of the COVID-19 pandemic, a huge number of industries have gone online, be it business or education. Though this has proven to be a boon for some, it has also resulted in loss for many. But one thing which has reached its peak during this unprecedented time is the number of Cyber Crimes across the globe. </p>
                    <p> In the past few months, we have come across reports of many data breaches in India, be it Dominos, Mobikwik or BigBasket where PII of millions of users were leaked. Reports also suggest that cyber criminals, hacktivists and threat actors from different countries are not only targeting private organizations but are also very keen to attack the Govt. sectors. At such times, it becomes very important for all organizations to improve and update their security at regular intervals to ensure a secure web experience for all stakeholders interacting with their web applications. </p>
                    <p> In the current scenario, it is felt necessary to build a digital task force team (Bengal Cyber Yoddha Team) under the aegis of West Bengal Cyber Security Incident Response Team (WB-CSIRT or State – CERT, as often referred to), Govt. of West Bengal to uphold the Cyber Security posture of the State. The Cyber Yoddha Team will be responsible for scanning &amp; testing different e-governance portals and create advisories for fixing available vulnerabilities. </p>
                </div>
            </div>
        </div>
    </section>
    <hr style="margin-bottom:0px;height:1px;background:orange;border:0px">
</main>

@stop
