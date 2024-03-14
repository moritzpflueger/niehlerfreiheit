<?php
  // Default state of $userAgreed should be false
  $userAgreed = false;
  
  // Check if the form was submitted and the checkbox was checked
  if (isset($_POST['agree'])) {
    $userAgreed = true;
  }
?>

<form method="POST" action="">
  <section class="p-5 sm:p-10 bg-neutral-900">
    <h2>NEWSLETTER</h2>
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

<script>
  document.getElementById('agree-checkbox').addEventListener('change', function() {
    document.getElementById('submit-button').disabled = !this.checked;
  });
</script>