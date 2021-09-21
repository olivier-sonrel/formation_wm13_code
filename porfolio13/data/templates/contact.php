<div class="container">
    <div class="cont-header">
        <h2>Démarrons un projet ensemble, n’hésitez pas à me contacter</h2>
    </div>
    <div class="cont-line"></div>
    <!-- <form name="contact-form" class="contact-form" action="mailto:olivier.sonrel@gmail.com" method="post">
        <input type="text" name="" placeholder="Votre Nom..."value="">
        <input type="email" name="" placeholder="Votre mail..." value="">
        <textarea name="name" placeholder="Expliquez-moi donc ce que vous voulez..."rows="8" cols="50"></textarea>
        <input type="submit" value="Send">
        <input type="reset" value="Reset">  
    </form> -->
    <form id="contact-form" class="contact-form">
        <input type="hidden" name="contact_number">
        <label>Votre nom</label>
        <input type="text" name="user_name" placeholder="Prenom NOM">
        <label>Email</label>
        <input type="email" name="user_email" placeholder="email.mail.ml">
        <label>Message</label>
        <textarea name="message" placeholder="Expliquez-moi donc ce que vous voulez..."rows="8" cols="50"></textarea>
        <div class="g-recaptcha" data-sitekey="6LdNncMZAAAAAGUr-7ZmGMoxD6oMewAlbu1zIhmO"></div>
      <br/>
        <input type="submit" value="Send">
        <input type="reset" value="Reset">
    </form>
</div>
