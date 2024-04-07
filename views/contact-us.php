<?php

include_once("../components/header.php");
include_once('../codes/contact_form.php');


?>

<section class="contact-us">
    
    <div class="section-header">
      <div class="contact-text">
        <h2>Contact Us</h2>
        <p>Feel free to reach out to us with any inquiries, questions, or specific requirements you may have. Our team of experienced professionals is ready to provide personalized assistance tailored to your unique needs.</p>
      </div>
    </div>
    
    <div class="container container-form">
      <div class="row">
        
        <div class="contact-info">
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-home"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Address</h4>
              <p>102 Rruga Muharrem Fejza, <br/> Prishtine <br/>55060</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-phone"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Phone</h4>
              <p>045-123-234</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-envelope"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Email</h4>
             <p>egzzanf@gmail.com</p>
            </div>
          </div>
        </div>
        
        <div class="contact-form">
        <?php include_once('../components/message.php'); ?>
          <form method="POST" id="contact-form">
            <h2>Send Message</h2>
            <div class="input-box">
              <input type="text" required="true" name="full_name">
              <span>Full Name</span>
            </div>
            
            <div class="input-box">
              <input type="email" required="true" name="email">
              <span>Email</span>
            </div>
            
            <div class="input-box">
              <textarea required="true" name="message"></textarea>
              <span>Type your Message...</span>
            </div>
            
            <div class="input-box">
              <input type="submit" value="Send" name="submit_form">
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </section>

<?php

include_once("../components/footer.php");
?>