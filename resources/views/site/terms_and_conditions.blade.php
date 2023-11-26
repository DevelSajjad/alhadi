@extends('layouts.frontend_layout')

@section('stylesheet')
<style>
  h1 {
    font-size: 40px;
    font-weight: 700;
    color: #8B75B3;
  }
</style>
@endsection

@section('content')
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
    <div class="ps-container">
      <div class="row">
        {{-- <div class="col-12 m-30">
          <div class="mb-10">
            <strong><b>OVERVIEW</b></strong>
          </div>
         <p class="ml-10">
           This website is operated by AL Hadi Enterprise®. The terms “We”, “Us” and “Our” are used to refer to only.
           <b>AL Hadi Enterprise</b> ® offers all information, tools and services which are used or concerns The user shall be
           deemed to have accepted all the terms, conditions, policies and notices officially stated, as they continue
           to use the website and its services.
         </p>
         <p class="ml-10">
           By visiting our website and/or purchasing something from us, you become a user of the website and engage in
           our “Services”. Such engagement will consecutively mean the user agreeing to be bound by the following terms
           and conditions (also referred to as “Terms of Service”, “Terms of use” or “Terms”), including those additional
           terms & conditions and policies referenced herein and/or available by hyperlink. These Terms of Service apply
           to all users of the website including, but not limited to, users who are browsers, vendors, customers, merchants,
           affiliations and/ or contributors of content.
         </p>
         <p class="ml-10">
           Please read this Terms of Service carefully before accessing or using our website or our services. By accessing
           or using any part of the website, you agree to be legally bound by these Terms of Service. If you do not agree
           to all the Terms of this agreement, then you may not access the website or use any of the services.
         </p>
         <p class="ml-10">
           Any new addition of features, service or tools shall also be deemed to be subject to the Terms of Service in
           force. You can review the most current version of the Terms of Service at any time on this page. We reserve
           the right to update, change or replace any part of these Terms & Conditions by posting updates and/or changes
           to our website. Therefore in order to stay updated on the Terms, please check this page periodically for changes.
           Your continued use of, or access to the website, following the posting of any changes constitutes acceptance of those changes.
         </p>


         <div class="mb-10 mt-60">
           <strong class="mb-10 mt-60"><b>SECTION 1 – GENERAL CONDITIONS</b></strong>
         </div>
         <p class="ml-10">
           By agreeing to these Terms of Service, you represent that you are at the age of majority in your present State or Province of residence, or that you have given us your consent to allow any of your minor dependents to use this website where you are the age of majority in your State or Province of residence.
         </p>
         <p class="ml-10">
           You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright laws). You must not transmit any worms or viruses or any code of a destructive nature. A breach or violation of any of the Terms will result in an immediate termination of your Services.
         </p>
         <p class="ml-10">
           We reserve the right to refuse service to anyone for any reason at any time. You understand that your content (not including credit card information), may be transferred unencrypted and may involve the following:
         </p>
         <div class="ml-10">
           <p class="margin-0">(a) transmissions over various networks; and</p>
           <p class="margin-0">(b) changes to conform and adapt to technical requirements of connecting networks or devices.</p>
         </div>
         <p class="ml-10">
           You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion of the Service, use of the Service, or access to the Service on the website through which the service is provided, without express written permission by us.
         </p>

         <div class="mb-10 mt-60">
           <strong><b>SECTION 2 – AVAILABILITY, PRICING AND PAYMENT METHODS</b></strong>
         </div>
         <p class="ml-10">
           Availability and pricing of all items are subject to availability.
           <b>AL Hadi Enterprise </b>
           ® will inform you as soon as possible, if the product(s) and services you have ordered are not available. If not, then the Customer Care will offer similar alternatives.
         </p>
         <p class="ml-10">
           As part of visiting and/or purchasing anything from AL Hadi Enterprise, you warrant to agree to understand that due to the nature of the business, availability may change even after an order has been placed. In an event where the product is no longer available, the Customer Care will offer alternatives or the option to cancel your order wholly.
         </p>
         <p class="ml-10">
           All prices are subject to change without notification, and while every effort is made to ensure the accuracy of the prices displayed on
           <b>alhadienterprise.com</b>,
           they are not guaranteed to be accurate. If any price is different from that displayed we will inform you before dispatching the order and you will have the option of continuing with the order or not.
         </p>
         <p class="ml-10">
           We reserve the right at any time to modify or discontinue any Service (or any part or content thereof) without notice at any time. We shall not be liable to any customer or to any third-party for any modification, price change, suspension or discontinuance of the Service.
         </p>
         <p class="ml-10">
           Choosing the right payment method is essential in order to shop with online stores. alhadienterprise.com is accepting payments in very easy and convenient ways.
         </p>


         <div class="mb-10 mt-60">
           <strong><b>SECTION 3 – PRODUCTS</b></strong>
         </div>
         <p class="ml-10">
           Products are available exclusively online through Pickaboo.com. These products or services may have limited quantities and are subject to return or exchange only according to our Return and Replacement Policy.
         </p>
         <p class="ml-10">
           <b>AL Hadi Enterprise </b>
           has made every reasonable effort to be as accurate as possible in displaying the product in its original color and accurate size. However, due to your device’s display settings, technical issues and differences in display, variations may come to the product’s color or size. Hence, AL Hadi Enterprise cannot guarantee that the physical product will look exactly like the display image. If a product from AL Hadi Enterprise  is not as described, your sole remedy is to return it unused by fulfilling all the conditions as per our Return and Replacement Policy.
         </p>
         <p class="ml-10">
           We reserve the right, but are not obligated, to limit the sales of our products or Services to any person, geographic region or jurisdiction. We may exercise this right on a case-by-case basis. We reserve the right to limit the quantities of any products or services that we offer, at any time. All descriptions of products or product pricing are subject to change at any time without notice, at the sole discretion of us. We reserve the right to discontinue any product at any time.
         </p>





         <div class="mb-10 mt-60">
           <strong><b>SECTION 4 – ACCURACY OF BILLING AND ACCOUNT INFORMATION</b></strong>
         </div>
         <p class="ml-10">
           We reserve the right to refuse any order you place with us. We may, in our sole discretion, limit or cancel quantities purchased per person or per order. These restrictions may include orders placed by or under the same customer account, the same credit card, and/or orders that use the same billing and/or shipping address. In the event that we make a change to or cancel an order, we may attempt to notify you by contacting through the phone number or e-mail provided at the time the order was made. We reserve the right to limit or prohibit orders that, in our sole judgment, appear to be placed by dealers, resellers or distributors.
         </p>
         <p class="ml-10">
           As a visitor or a customer, you agree to provide current, complete and accurate account information for all purchases made at our store. You also agree to promptly update your account and other information, including your email address and credit card numbers and expiration dates, so that we can complete your transactions and contact you as needed.
         </p>
         <p class="ml-10">
           Each user accounts must be created under one distinctive registered
           <b>Cell Phone number</b>
           , and email address of the user. Multiple accounts cannot be created under the same information as mentioned. In such an event the user cannot avail more than once any of the offers, deals, discount coupons, or Gift Coupons during campaigns or other occasional sales.
         </p>



         <div class="mb-10 mt-60">
           <strong><b>SECTION 5 – PERSONAL INFORMATION</b></strong>
         </div>
         <p class="ml-10">
           Your submission of personal information through the store is governed by our Privacy Policy. Visit our website to learn more about our
           <a href="{{ route('privacy.policy') }}">Privacy Policy</a>.
         </p>



         <div class="mb-10 mt-60">
           <strong><b>SECTION 6 – ERRORS, INACCURACIES AND OMISSIONS</b></strong>
         </div>
         <p class="ml-10">
           Occasionally there may be information on our website or some Services containing typographical errors, inaccuracies or omissions that may relate to product descriptions, pricing, promotions, offers, product shipping charges and availability. We reserve the right to correct any errors, inaccuracies or omissions, and to change or update information or cancel orders if any information, on our or on any related website, is inaccurate at any time without prior knowledge (including after you have submitted your order or concern).
         </p>
         <p class="ml-10">
           We undertake no obligation to update, amend or clarify information on our or on any related website, including without limitation, pricing information, except as required by law.
         </p>
         <p class="ml-10">
           No specified update or refresh date applied in the Service or, on any related website, should be taken to indicate that all information in the Service or on any related website has been modified or updated.
         </p>



         <div class="mb-10 mt-60">
           <strong><b>SECTION 7 – ORDER CANCELLATION</b></strong>
         </div>
         <p class="ml-10">
           AL Hadi Enterprise promises to deliver quality and authentic products to their customers. Therefore, alhadienterprise.com always runs Quality Control checks after receiving the ordered product from the authorized vendors. AL Hadi Enterprise reserves all rights to cancel any order of the customer after finding any quality issue from Quality Control checks of the ordered product, as we aim to give our customers the best online shopping experience.
         </p>
         <p class="ml-10">
           <b>AL Hadi Enterprise</b>. also reserves all rights to cancel any order if the ordered product is unavailable or if it is out-of-stock. Product unavailability cannot be predetermined or predicted by the website, whether it is due to unavoidable inventory management issues, website management issues, vendor stock update issues or any other unpredictable reason.
         </p>

         <div class="mb-10 mt-60">
           <strong><b>SECTION 8 – PROHIBITED USES</b></strong>
         </div>
         <p class="ml-10">
           In addition to other prohibitions as set forth in the Terms of Service, you are prohibited from using the website or its contents:
         </p>
         <div class="ml-10">
           <p class="margin-0">(a)	For any unlawful purpose.</p>
           <p class="margin-0">(b)	To solicit others to perform or participate in any unlawful acts.</p>
           <p class="margin-0">(c)	To submit false or misleading information. </p>
           <p class="margin-0">(d)  To upload or transmit viruses or any other type of malicious code that will or may be used in any way that will affect the functionality or operation of the Service or of any related website, other websites, or the Internet.</p>
           <p class="margin-0">(e)	To spam, phish, pharm, pretext, spider crawl, or scrape.</p>
           <p class="margin-0">(f)	Fake orders of any kind are not accepted and customers need to choose the method of payments as per company policy in order to receive deliveries of the products. Example: Customers not receiving an order after confirming it intentionally will be counted as a fake order.</p>
         </div>

         <div class="mb-10 mt-60">
           <strong><b>SECTION 9– GOVERNING LAW</b></strong>
         </div>
         <p class="ml-10">
           These Terms of Service and any separate agreements whereby we provide you Services shall be governed by and construed and interpreted in accordance with the applicable laws governing e-Commerce in Bangladesh. Any and all actionable legal claim or proceedings arising out of, or in connection to this website, must be brought within the jurisdiction of a competent Court in Bangladesh.
         </p>

         <div class="mb-10 mt-60">
           <strong><b>SECTION 10 – CONTACT INFORMATION</b></strong>
         </div>
         <p class="ml-10">
           For more information regarding the Terms of Service or if you have any queries or concerns you can <a
             href="{{ route('contactus') }}">Contact Us</a> or for any questions about the Terms of Service should be sent to us at support@alhadienterprise.com or .
         </p>

        </div> --}}
        
        <div class="col-md-12 text-center">
          <h1> {{ $term?->title_en }} </h1>
        </div>
        <div class="col-md-12 m-30">
          <div class="mb-10">
            <strong><b>OVERVIEW</b></strong>
          </div>
          <div class="col-md-12 m-30">
            <p> {!! $term?->overview !!} </p>
          </div>

          <div class="col-md-12">
            {!! $term?->description !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')


@endsection


