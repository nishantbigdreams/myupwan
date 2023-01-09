<?php echo $__env->make('_partials.website.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.min.css')); ?>">
<body class="about-us">

    <div class="page-wrapper">
        <?php echo $__env->make('_partials.website.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- End Header -->
        <main class="main">
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo e(url('/')); ?>"><i class="d-icon-home"></i></a></li>
                        <li>Disclaimer</li>
                    </ul>
                </div>
            </nav>
            <div class="page-header pl-4 pr-4" style="background-image: url(images/page-header/about-us.jpg)">
                <h1 class="page-title font-weight-bold lh-1 text-white text-capitalize">Disclaimer</h1>
            </div>
            <div class="page-content mt-10 pt-10">
                <section class="about-section pb-10 appear-animate">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12 mb-10 mb-lg-4">
                                <h5 class="section-subtitle lh-2 ls-md font-weight-normal">By accessing this website you have read, understood and agree to be legally bound by the terms of the following disclaimer. if you don't agree with any of our disclaimers below please do not read the material on any of our website’s pages:</h5>
                                <p class="section-desc">The information contained in this website www.myupavan.com are made available on an "as is" and "as available" basis and updated from time to time, excluding any representation, promise or warranty of any kind, express or implied, as to the quality, accuracy, efficacy, completeness, performance, fitness or any other contents of the website, including but not limited to any comments, feedback and advertisements contained within the website. To the fullest extent permissible pursuant to applicable law, My Upavan, its officers, employees, and agents (the “My Upavan”) disclaim all warranties, express, implied or statutory, including warranties of/relating to (i) title and non-infringement, (ii) merchantability and fitness for a particular purpose or use, (iii) the adequacy, accuracy, timeliness, quality, safety or completeness of any information or content available through the website, (iv) that the website will be available for use, uninterrupted, error free or secure, or that all features, functions or operations of the website will be available or perform as described or that any errors will be corrected, (v) the website (including files available for download from or through the website) or the server(s) on which the website is hosted are free of viruses or other harmful components. No opinion, advice, or statement of My Upavan or its agents, customers, or users, whether made in these terms of use, on the website or otherwise, shall create any warranty.</p>
                                <p class="section-desc">Your use of the website and any and all information or content that you view, download or otherwise obtain from or through the website is at your own risk. Under no circumstances shall My Upavan’s parties be liable to you for any loss, damage or expense incurred in connection with your use of or inability to use the website or your use of or reliance on any information or content that you view, download or otherwise obtain from or through the website.</p>
                                <p class="section-desc">Under no circumstances shall My Upavan parties be liable to you for any loss, damage or expense incurred in connection with any misrepresentation or other breach of these terms by another user, or any communication, activity, business dealing or transaction between you and any other third party. </p>
                                <p class="section-desc">My Upavan shall have no liability for, and you agree to waive any and all rights against My Upavan parties and hold My Upavan parties harmless in connection with, any claims relating to (i) any action taken or not taken by My Upavan parties as part of an investigation of a suspected violation of these terms, and (ii) any steps taken or not taken by My Upavan parties in response to a conclusion that a violation of these terms has occurred or not occurred.</p>
                                <p class="section-desc">Regardless of the form of action, whether tort, breach of contract, breach of warranty, strict liability, or otherwise, in no event shall My Upavan and/or My Upavan parties be liable to you for any indirect, consequential, exemplary, incidental or punitive damage or expense, including loss of business, lost profits or other economic damage of any kind arising from or related to your use of (or your inability to use) the website or arising from any other cause, even if My Upavan and/or My Upavan parties have been advised of the possibility or foreseeability of such damage or expense.</p>
                                <p class="section-desc">The linked sites, if any, are not under our control and we are not responsible for the contents of any linked site or any link contained in a linked site, or any changes or updates to such sites. My Upavan is providing these links to you only as a convenience, and the inclusion of any link does not imply endorsement by us of the site.</p>
                                <p class="section-desc">We reserve the right to make changes to our website and these disclaimers, terms and conditions at any time without prior notice.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End About Section-->
            </div>
        </main>
        <!-- End Main -->
        <?php echo $__env->make('_partials.website.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <script src="<?php echo e(asset('vendor/jquery.count-to/jquery-numerator.min.js')); ?>"></script>
</body>

</html>