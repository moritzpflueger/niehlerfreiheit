<div id="menuModal" class="modal">
  <div class="modal-content p-5 overflow-y-auto">
    <span class="close-button">
      <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
      </svg>
    </span>
        <?php 
          $menuItems = [
            ['title' => 'Programm', 'uri' => 'events'],
            ['title' => 'Verein', 'uri' => 'verein'],
          ];
          foreach ($menuItems as $item):
            $isActive = $page->uri() === $item['uri'];
        ?>
          <li>
            <a href="<?= $site->url() ?>/<?= $item['uri'] ?>" class="<?= $isActive ? 'text-yellow-500' : '' ?>">
              <?= $item['title'] ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById('menuModal');

// Get the button that opens the modal
var btn = document.getElementById('menu-button');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName('close-button')[0];

// When the user clicks on the button, open the modal and disable scrolling
btn.onclick = function() {
  modal.style.display = 'block';
  document.body.classList.add('no-scroll'); // Disable scrolling
}

// When the user clicks on <span> (x), close the modal and enable scrolling
span.onclick = function() {
  modal.style.display = 'none';
  document.body.classList.remove('no-scroll'); // Enable scrolling
}

// When the user clicks anywhere outside of the modal, close it and enable scrolling
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
    document.body.classList.remove('no-scroll'); // Enable scrolling
  }
}
</script>
