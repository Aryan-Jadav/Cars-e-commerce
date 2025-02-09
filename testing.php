<?php include ('header.php'); ?>
<main>
  <section class="contact">
  <div class="layout">   
        <div class="text-center">
          <h1 class="section-title">Contact Us Layout</h1>
          <p>Get in touch with AJ's FastLane to explore our extensive inventory of new and used cars. Our dedicated team is here to help you find the perfect vehicle for your needs. Contact us today to schedule a test drive or ask any questions!.</p>
        </div>
        <div class="grid-8 form">
          <form action="php/email.php" method="post" id="contact_form" name="contactForm">
            <div class="form-inline clearfix">
              <div class="form-group grid-6 ">
                <input type="text" placeholder="name" id="exampleInputName" name="name" class="form-control">
              </div>
              <div class="form-group grid-6">
                <input type="email" placeholder="email address" id="exampleInputEmail" name="email" class="form-control">
              </div>
              <div class="form-group grid-6">
                <input type="text" placeholder="subject" id="exampleInputSubject" name="subject" class="form-control">
              </div>
              <div class="form-group grid-6">
                <input type="text" placeholder="company" id="exampleInputCompany" name="company" class="form-control">
              </div>
              <div class="form-group grid-12">
                <textarea placeholder="message" id="exampleInputMessage" rows="3" name="message" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div style="display:none;" class="success" id="mail_success">Your message has been sent successfully.
              </div><!-- success message -->
              <div style="display:none;" class="error" id="mail_fail"> Sorry, error occured this time sending your message.
              </div><!-- error message -->
            </div>
            <div id="submit" class="form-group grid-12">
              <input type="submit" value="send" class="btn  btn-lg costom-btn" id="send_message">
            </div>
          </form>
        </div> <!-- /.col-xs-12 .col-sm-offset-2 .col-sm-8 -->
        <div class="grid-12">       
          <div class="icon-text">
            <span>find us on</span>
          </div><!-- /.icon-text -->
          <div class="icon-holder">
            <ul>
              <li><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a target="_blank" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a target="_blank" href="#"><i class="fa fa-behance"></i></a></li>
              <li><a target="_blank" href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div><!-- /.icon-holder -->
        </div><!-- /.col-xs-12 -->     
  </div>  
</section>
</main>
<?php include ('footer.php'); ?>