@extends('layouts.master')

@section('title') Information @stop

@section('content')
    <div class="row informationWrap">
        <div class="col-xs-10">
            <div class="page-header">
                <h2>Information</h2>
            </div>

            <p> The inkjet printer has come a long way in the last 30 years. The technology has evolved, print quality has improved, and prices have 
                   come down. Acid-free/archival paper and pigment-based inks are easy to find and affordable. If you have Internet access and a decent 
                   inkjet printer, it's never been easier to get quality photographic and digital art prints, instantly. Welcome to a pay-and-print system for buying 
                  and selling images. All of our Photo files are at least 300 dpi.* The customer controls the materials, so the customer controls the quality. For 
                  print buyers it's faster, as in immediate - and it's cheaper. For artists it's easy, with no overhead and no need to hand over your image 
                  files to customers. And for everyone involved, it's greener. No shipping means no delivery trucks.</p>
            <p> *Images in the Digital  Art category cover a wide range of resolutions, as high as necessary, may be less than 300.</p>
                   <p><strong>~~ Improved printing app now gives you access to your printer's full menu of options, including Paper Type. ~~</strong></p>

            <div class="row informationalRow">
                <div class="col-sm-2 col-xs-12">
                    <h2>Buy Prints</h2>
                </div>

                <div class="col-sm-10 col-xs-12">
                    <p><strong>Inkjet printers. Steps:</strong></p>
                    <p><strong>1)</strong> Turn on printer, load in your paper.</p>
                    <p><strong>2)</strong> Submit payment through PayPal.</p>
		    		<p><strong>3)</strong> Launch the app and give it permission to run.</p>
                    <p><strong>4)</strong> Enter your code into the Prinstantly dialog box, click "Print". Your usual printer dialog box will open.</p>
		    		<p><strong>5)</strong> Select your paper type and print quality settings. Then click "Print"!</p>
                    <div class="row">
                        <div class="col-sm-12">
                            <p><strong></strong></p>
                        <div><strong>*Mac Users.</strong> You will likely see this pop-up message: "Prinstantly.jar can't be opened because it is from an unidentified developer." Simply go to 
                                     where the app is (either Downloads or Desktop, for most people), right-click on the icon, then select "Open" from the context menu.
                            </div>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <p><strong>Laser printers:</strong> Due to their limitations, and the wide variability of results, we cannot guarantee print quality for users with laser printers. If there 
                               is an expert on your laser printer's photo capabilities, it's probably you. To learn more on this topic, read here 
                <a href="http://www.photoreview.com.au/tips/outputting/printing-photos-with-a-laser-printer" target="_blank">http://www.photoreview.com.au/tips/outputting/printing-photos-with-a-laser-printer</a>. 
                 If you know your laser printer well and/or would like to give it a try, feel free, but please note that refunds won't be given for inadequate results using a laser printer.</p>
                </div>
            </div>


            <div class="row informationalRow">
                <div class="col-sm-2 col-xs-12">
                    <span class="informationalTitle">Additional Info for Printing </span>
                </div>

                <div class="col-sm-10 col-xs-12">
                <p><b>**</b> Ink levels. Most printers are not very accurate at gauging how much ink is left inside ink
                        cartridges, and so “Ink Levels” displayed can't always be trusted. If any one of your
                        cartridges is below 10% you're in risky territory and the ink may run out during printing or the
                        print quality may suffer. 10% is a rough estimate, your printer may vary.</p>
                <p><b>**</b> The app must be downloaded before it can be launched. Where it downloads to depends on your
                        system settings. For most of us that place is either the Desktop or in “Downloads”. Just
                        locate it and double-click it. (Or right-click and select “Open”.) In some cases, as with
                        Firefox and Internet Explorer, it can be launched from your browser.</p>
                <p><b>**</b> Java is required to run the printing app. To find out if your computer has Java or to get the
                        latest version - for free - go here: <a href="https://www.java.com/" target="_blank">https://www.java.com/</a>
                    </p>
                <p><b>**</b> Air conditioner running? If a large appliance in the same room as your printer turns on or off
                        during the printing process, it may effect the consistency of your print. For best results, turn
                        any such appliance off. Or if it has to be on, make sure it stays on throughout the
                        printing.</p>
                </div>
            </div>

            <a name="sell"></a>
            <div class="row informationalRow">
                <div class="col-sm-2 col-xs-12">
                    <h2>Sell Prints</h2>
                </div>

                <div class="col-sm-10 col-xs-12">
                    <p>Not every work of art or photograph works well in the 8.5x11" format, but if you have ones that do,
                        is this ever the website for you! Welcome to the “no overhead” way of selling digital art and photos
                        online. The formula is simple. For every print sold, you keep 60% and we keep 40%. And that's
                        it. The rest is passive income! Uploading is done by Prinstantly. The more popular your
                        photos are, the more money you make.</p>
                    <p>Your image files remain in your possession. As we all know, once something gets on the Internet
                        there is no getting it back. On Prinstantly.com, customers see a preview and a watermarked
                        version of your work, but not the high quality image - until they print it. Your high resolution
                        image files are never accessed by or visible to the customer.</p>
                    <p>Take large, high-end, high-priced photos? Create wall- or over-sized works of art? Use
                        Prinstantly.com to let prospective customers purchase a “trial size” version of your work, to
                        see if the vibe is right for the room where they want to hang it, before committing to buying
                        the real thing.</p>
                    <p>To request membership click here: <a href="{{ URL::to('/request-membership') }}"><img
                                    src="/img/request-button.png"/></a> If accepted, you will be invited to create an
                        artist account.</p>
                </div>
            </div>

            <div class="row informationalRow">
                <div class="col-sm-2 col-xs-12">
                    <h2>Note</h2>
                </div>

                <div class="col-sm-10 col-xs-12">
                    <p>This is a first-of-its-kind website, and while the printing app works correctly on all the
                        computers and printers we've tried, there may be exceptions to the rule. For any problem that
                        arises which leads to a less then stellar print (such as an image that is greatly off-center),
                        please let us know at <a href="mailto:{{ encodeEmail('hey@prinstantly.com') }}"><img
                                    src="/img/email-button.png" height="20"/></a>.</p>
                </div>
            </div>

        </div>
    </div>
@include('layouts.revive')

@stop