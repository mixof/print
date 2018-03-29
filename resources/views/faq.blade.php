@extends('layouts.master')

@section('title') Frequently Asked Questions @stop

@section('content')
    <div class="row informationWrap">
        <div class="col-xs-10">
            <div class="page-header">
                <h1>Frequently Asked Questions</h1>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h4>Print Buyers</h4>

                    <div class="faq_question">How is the paper type selected?</div>
                    <div class="faq_answer">After entering your code into the Prinstantly dialog box, click "Print". Your printer's normal dialog box will open
                        with all your usual menu options. Select the exact paper type you have, your desired print quality, and any other relevant settings, then 
                        click "Print" again. (Paper size is preset to 8.5 x 11 inches and Number of copies is preset to 1.)</div>
                        <br/>
                     <div class="faq_question">Is there a way to minimize the border size and maximize the printed area?</div>
                     <div class="faq_answer">Yes. If you see the option "Borderless printing", check that box.</div>
                     
                  <!--  <div class="row">
                        <div class="col-sm-1 hidden-xs">&nbsp;</div>
                        <div class="col-xs-12 col-sm-4 text-center vcenter">
                            <img src="{{ URL::asset('img/samples/FAQ twilight 340.png') }}"
                                 class="img-responsive" alt=""/>
                        </div>
                        <div class="col-sm-1 col-xs-12">&nbsp;</div>
                        <div class="col-xs-12 col-sm-4 text-center vcenter">
                            <img src="{{ URL::asset('img/samples/FAQ figs 340.png') }}"
                                 class="img-responsive" alt=""/>
                        </div>
                        <div class="col-sm-2 col-xs-12">&nbsp;</div>

                        <div class="col-xs-12">&nbsp;</div>
                        <div class="col-sm-1 hidden-xs"></div>
                        <div class="col-xs-12  col-sm-4 text-center vcenter">
                            <img src="{{ URL::asset('img/samples/FAQ steps 340.png') }}"
                                 class="img-responsive" alt=""/>
                        </div>
                        <div class="col-sm-1 col-xs-12">&nbsp;</div>

                        <div class="col-xs-12 col-sm-4 text-center vcenter">
                            <img src="{{ URL::asset('img/samples/FAQ marigold 340.png') }}"
                                 class="img-responsive faq-image-4" alt=""/>
                        </div>
                        <div class="col-sm-2 col-xs-12">&nbsp;</div>

                    </div>
                    <div class="clearfix"></div>
                    <br/><br/>

                    <div class="faq_question">
                    </div>
                    <div class="faq_answer"></div>-->
                    <br/>
                    <br/>
                    <h4>Photographers</h4>

                    <div class="faq_question"></div>
                    <div class="faq_answer"></div>

                    <div class="faq_question"></div>
                    <div class="faq_answer">

                    </div>
                </div>
            </div>

        </div>
    </div>

@include('layouts.revive')
@stop