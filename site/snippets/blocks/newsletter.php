<?php
  // Default state of $userAgreed should be false
  $userAgreed = false;
  
  // Check if the form was submitted and the checkbox was checked
  if (isset($_POST['agree'])) {
    $userAgreed = true;
  }
?>

<form method="POST" action="" class="hidden">
  <section class="p-5 sm:p-10 bg-neutral-900">
    
    <p class="my-10">
      <?= t('newsletter.subscribe.text') ?>
    </p>
    <div class="flex flex-wrap items-center w-full gap-5">
      <input type="text" name="email" class="flex-1 py-3 px-5 text-black" placeholder="E-Mail">
      <button
        id="submit-button"
        class="bg-yellow-500 text-black text-xl w-full font-bold py-3 px-5"
        <?= $userAgreed ? '' : 'disabled' ?>
      >
        <?= t('newsletter.subscribe.button') ?>
      </button>
    </div>
    <label class="text-white">
      <input
        type="checkbox" 
        id="agree-checkbox"
        class="mt-10"
        name="agree"
      >
      <!-- <?= t('newsletter.subscribe.agree') ?> -->
      Ich bin damit einverstanden, dass meine Daten gespeichert und verarbeitet werden.
    </label>
  </section>
</form>

  <section class="p-5 sm:p-10  border-[#00538A] border-2">
    

  

<h2><?= $block->heading() ?></h2>

<p class="my-10 text-neutral-400">
  <?= $block->text() ?>
</p>

<div id="mc_embed_signup">

    <form 
      method="post" 
      action="http://niehlerfreiheit.us15.list-manage.com/subscribe/post?u=41d960ced025df8815eac9202&amp;id=3b29e6d44a" 
      id="mc-embedded-subscribe-form" 
      name="mc-embedded-subscribe-form" 
      class="validate w-full" 
      target="_blank" 
      novalidate=""
    >
      <div id="mc_embed_signup_scroll" class="w-full flex flex-col">

        <!-- <label for="mce-FNAME" class="mb-3">
          Vorname<span class="asterisk" placeholder="Name">*</span> 
        </label> -->
        <!-- <input value="" name="FNAME" class="required flex-1 py-3 px-5 text-black mb-5" id="mce-FNAME" type="text" placeholder="Vorname"> -->


        <!-- <label for="mce-LNAME">Nachname<span class="asterisk">*</span> </label> -->
        <!-- <input value="" name="LNAME" class="required flex-1 py-3 px-5 text-black mb-5" id="mce-LNAME" type="text" placeholder="Nachname"> -->

        <!-- <label for="mce-EMAIL" class="mb-3">E-Mail<span class="asterisk">*</span> </label> -->
        <input value="" name="EMAIL" class="required email flex-1 py-3 px-5 mb-5 sm:mb-10 text-black" id="mce-EMAIL" type="email" placeholder="E-Mail">


        <!-- <p style="margin: 0pt; text-align: center; font-size: 12px;">(*Pflichtangabe)</p><br> -->
<!-- 

        <input 
          style="margin: 0pt; padding: 0pt; width: 30px;" 
          value="1" 
          name="group[1715][1]" 
          id="mce-group[1715]-1715-0" 
          type="checkbox"
        >
        <label for="mce-group[1715]-1715-0">
          (Ich möchte Fördermitglied werden, und akzeptiere die <a href="vereinssatzung.html">Vereinssatzung)</a>
        </label>
        
        <input 
          style="margin: 0pt; padding: 0pt; width: 30px;" 
          value="2" 
          name="group[1719][2]" 
          id="mce-group[1719]-1719-0" 
          type="checkbox"
        >
        <label for="mce-group[1719]-1719-0">
          (Ich möchte den Newsletter erhalten)
        </label> -->

        <div id="mce-responses" class="clear">
          <div class="response" id="mce-error-response" style="display: none;"></div>
          <div class="response" id="mce-success-response" style="display: none;"></div>
        </div>
        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style="position: absolute; left: -5000px;" aria-hidden="true">
          <input name="b_41d960ced025df8815eac9202_3b29e6d44a" tabindex="0" value="" type="text">
        </div>

        <div class="clear">
          <input 
            class="bg-yellow-500 text-black text-2xl w-full font-bold py-3 px-5" 
            value="Subscribe" 
            name="subscribe" 
            id="mc-embedded-subscribe" 
            class="button" 
            type="submit"
          >
        </div>

      </div>
    </form>
  </div>
</section>
<script>
  document.getElementById('agree-checkbox').addEventListener('change', function() {
    document.getElementById('submit-button').disabled = !this.checked;
  });
</script>