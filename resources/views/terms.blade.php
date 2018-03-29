@extends('layouts.master')

@section('title') Terms and Privacy @stop

@section('content')
    <div class="row informationWrap">
        <div class="col-xs-10">
            <div class="page-header">
                <h1>Terms of Use and Privacy Policy</h1>
            </div>

            <h4>1. Terms</h4>

            <p>By accessing this website you are agreeing to be bound by these website Terms and
                Conditions of Use, all applicable laws and regulations, and agree that you are
                responsible for compliance with any applicable local laws. If you do not agree with
                any of these terms, you are prohibited from using or accessing this site. The
                materials contained in this web site are protected by applicable copyright and trade
                mark law. For the purposes of this notice the terms “user” and “buyer” are
                interchangeable, and the terms "artist" and “seller” are
                interchangeable.</p>

            <h4>2. Use License</h4>

            <p>The artwork and photos on this site are the sole copyright and intellectual property of the
                artists.</p>

            <style type="text/css">
                /* tricky list */
                ol.trickylist {
                    counter-reset: list;
                }
                ol.trickylist > li {
                    list-style: none;
                    padding-left: 30px;
                }
                ol.trickylist > li:before {
                    content: counter(list, lower-alpha) ". ";
                    counter-increment: list;
                    margin-left: -30px;
                    padding-right: 15px;
                }
            </style>
            <ol class="trickylist">
                <li>Permission is granted to use the printing application to print one image per
                    purchase from Prinstantly.com. This is the grant of a license, not a transfer of
                    title, and under this license you may not copy, reproduce, or distribute the
                    materials.
                </li>
                <li>You may not attempt to decompile or reverse engineer any software contained on
                    Prinstantly.com
                </li>
                <li>This license shall automatically terminate if you violate any of these
                    restrictions and may be terminated by Prinstantly at any time.
                </li>
            </ol>

            <h4>3. Disclaimer</h4>

            <p>The pay-and-print system on Prinstantly.com is a collaborative effort and involves
                the use of the buyer's own printer—printing is done by the buyer. As such, print
                quality is ultimately determined by the precision, quality, and fitness of your
                printer and its component parts and your ink cartridges. The user should confirm
                beforehand the status of all technical aspects of their printer necessary for the
                printing of a high quality image. Photo files in use on Prinstantly are of a
                minimum of 300 dots per inch (DPI); digital art files may be less. While most inkjet
                printers made in the last ten
                years are capable of extremely high print quality, including photo print quality,
                not every printer is the same and there will be some variations in quality from user
                to user, printer to printer.</p>

            <p>The printing application on Prinstantly utilizes Java, therefore the user's
                computer must have Java installed and activated. (To find out if your computer has
                Java or to get the latest version - for free - go here:
                <a href="https://www.java.com/" target="_blank">https://www.java.com/</a> )
                The application must be downloaded, launched and/or given permission to run; this may require the user to
                adjust security settings or to create an exception for Prinstantly.com.</p>

            <p>In order for us to pay our artists in a timely manner, you must launch the
                printing app and use your authorization code <strong>within 3 days (72
                    hours)</strong> after payment approval. Refunds will not be given to buyers
                whose authorization code has not been used within 3 days of payment and has
                therefore expired.</p>

            <p>If you believe that the quality of your print severely departs from what is
                represented on your computer screen due to no fault of your own or your equipment,
                you may request a refund. Refunds must be requested <strong>within 7 days (168
                    hours)</strong> after purchase. Refunds will only be given in certain cases,
                namely, in cases where the application is deemed to have malfunctioned. Refunds will
                not be given in cases of user error, mishap, or printer malfunction. This includes:
                photo paper facing the wrong way, running out of ink, paper jam, a power cord
                unplugged mid-print, damaged or clogged print heads, power outage/failure, or other
                unforeseen mishaps on the buyer's end.</p>

            <h4>4. Links</h4>

            <p>Prinstantly.com has not reviewed all of the sites linked to its Internet website and
                is not responsible for the contents of any such linked site. The inclusion of any
                link does not imply endorsement by Prinstantly of the site. Use of any such
                linked website is at the user's own risk.</p>

            <h4>5. Site Terms of Use Modifications</h4>

            <p>Prinstantly.com may revise these terms of use for its website at any time without
                notice. By using this website you are agreeing to be bound by the then current
                version of these Terms and Conditions of Use.</p>

            <div class="page-header">
                <h1>Print Sellers (Artists)</h1>
            </div>

            <p>The images you offer through Prinstantly.com remain your sole copyright and
                intellectual property. By joining Prinstantly as an artist you are
                attesting and agreeing that the works you submit are your own, and that you
                control all rights to them. By making your
                images available on Prinstantly you are not relinquishing any copyrights or
                intellectual property rights to them.</p>

            <p>The only things required to sell prints and receive payments as a seller on
                Prinstantly.com are: a PayPal account in good standing, your name, a valid email
                address, and the ability to send image files either as JPG's or PNG's.</p>

            <p>Artists are paid every Thursday for the previous week's sales. For each sale,
                artists receive 60% of the sale price and Prinstantly.com receives 40%. For
                precise details on when the pay period begins and ends please contact us at
                <a href="mailto:{{ encodeEmail('hey@prinstantly.com') }}"><img src="/img/email-button.png" height="20" /></a></p>

            <div class="page-header">
                <h1>Privacy Policy</h1>
            </div>

            <h4>1. Print Buyers</h4>

            <p>The only thing required to purchase a print is a PayPal account in good standing.</p>

            <p>We have access, in our PayPal account, only to whatever information is generated by a
                standard PayPal transaction; namely, the buyer's name, PayPal email address, the
                date and amount of payment, and the transaction ID number. We would only refer to
                this information in the event of a dispute or refund request or some other issue
                requiring us to review the details or contact the buyer. This information will not
                be used in any other way and will not be shared with any outside party.</p>

            <p>For each purchase the only information retained by Prinstantly is the date and
                time of the order, the dollar amount, the artist/title of the print, the validation
                code, and whether or not the image has been printed. No personal information is
                gathered by or stored on Prinstantly.com. Purchases are PayPal transactions between
                the buyer and Prinstantly, not between buyer and artist directly.</p>

            <h4>2. Print Sellers / Artists</h4>

            <p>When creating your account you will be asked to choose a display name, which will be
                public. This can be your real name or a screen name, the decision is yours. If you
                upload a headshot/profile photo, that will be public, as will whatever you write in
                the Bio area. (Uploading a headshot and writing a bio are both optional.) All
                aspects of your public profile are editable; simply log into your account and click
                on the “My Profile” tab.</p>

            <p>Print buyers are not given any other artist information beyond what is publicly
                displayed on the website. Purchases are transactions that take place between the
                buyer and Prinstantly; artists are paid at a later time.</p>

            <p>The “Required” information in your account is for the purposes of making a public
                profile feasible and for maintaining a working relationship with you. Your
                information is not shared with any outside / third party.</p>

        </div>
    </div>

@include('layouts.revive')

@stop