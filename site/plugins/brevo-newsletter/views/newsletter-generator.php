<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsletter Generator - Niehler Freiheit</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background: #f0f0f0;
      color: #16171a;
      line-height: 1.5;
    }
    
    .top-bar {
      background: #fff;
      border-bottom: 1px solid #ddd;
      padding: 0.75rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.875rem;
      color: #777;
    }
    
    .breadcrumb a {
      color: #16171a;
      text-decoration: none;
      transition: color 0.2s;
    }
    
    .breadcrumb a:hover {
      color: #4271ae;
    }
    
    .breadcrumb-home {
      width: 16px;
      height: 16px;
      fill: currentColor;
    }
    
    .breadcrumb-separator {
      color: #999;
    }
    
    .btn-publish {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: #4271ae;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 3px;
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }
    
    .btn-publish:hover:not(:disabled) {
      background: #2e5a94;
    }
    
    .btn-publish:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
    }
    
    .content {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 2rem;
    }
    
    .card {
      background: transparent;
      border-radius: 0;
      padding: 2rem;
      box-shadow: none;
    }
    
    .card-title {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #efefef;
    }
    
    .form-group {
      margin-bottom: 1.5rem;
    }
    
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }
    
    label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #16171a;
    }
    
    select, textarea, input[type="text"], input[type="url"] {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 3px;
      font-family: inherit;
      font-size: 0.875rem;
      background: white;
      transition: border-color 0.2s;
    }
    
    input[type="file"] {
      width: 100%;
      padding: 0.5rem 0;
      border: none;
      font-family: inherit;
      font-size: 0.875rem;
      background: white;
    }
    
    select:focus, textarea:focus, input:focus {
      outline: none;
      border-color: #4271ae;
    }
    
    textarea {
      min-height: 120px;
      resize: vertical;
    }
    
    .help-text {
      font-size: 0.75rem;
      color: #777;
      margin-top: 0.25rem;
    }
    
    .events-list {
      list-style: none;
      padding: 0;
    }
    
    .event-item {
      padding: 0.75rem;
      border-bottom: 1px solid #efefef;
    }
    
    .event-item:last-child {
      border-bottom: none;
    }
    
    .event-item-title {
      font-weight: 600;
      font-size: 0.875rem;
      margin-bottom: 0.25rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .event-badge {
      background: #4271ae;
      color: white;
      font-size: 11px;
      padding: 2px 6px;
      border-radius: 3px;
      font-weight: normal;
    }
    
    .event-meta {
      font-size: 0.75rem;
      color: #777;
    }
    
    .empty-state {
      text-align: center;
      padding: 2rem;
      color: #999;
      font-size: 0.875rem;
    }
    
    .message {
      padding: 1rem;
      border-radius: 3px;
      margin-bottom: 1rem;
      font-size: 0.875rem;
    }
    
    .message.success {
      background: #d1fae5;
      border: 1px solid #6ee7b7;
      color: #065f46;
    }
    
    .message.error {
      background: #fee2e2;
      border: 1px solid #fca5a5;
      color: #991b1b;
    }
    
    @media (max-width: 768px) {
      .content {
        grid-template-columns: 1fr;
      }
      
      .form-row {
        grid-template-columns: 1fr;
      }
      
      .top-bar {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
      }
    }
  </style>
</head>
<body>
  <div class="top-bar">
    <nav class="breadcrumb">
      <a href="/panel">
        <svg class="breadcrumb-home" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
          <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4h3v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354l-6-6Z"/>
        </svg>
      </a>
      <span class="breadcrumb-separator">/</span>
      <a href="/panel">Niehler Freiheit</a>
      <span class="breadcrumb-separator">/</span>
      <span>Newsletter Generator</span>
    </nav>
    
    <button type="button" id="createDraftBtn" class="btn-publish">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
      </svg>

      Create Draft Newsletter and send to Brevo
    </button>
  </div>
  
  <div class="container">
    <div id="message"></div>
    
    <div class="content">
      <div class="card">
        <h2 class="card-title">Newsletter Content</h2>
        
        <form id="newsletterForm">
          <div class="form-group">
            <div class="form-row">
              <div>
                <label for="month">Month</label>
                <select id="month" name="month" required>
                  <option value="">-- Select Month --</option>
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </div>
              <div>
                <label for="year">Year</label>
                <select id="year" name="year" required>
                  <option value="">-- Select Year --</option>
                  <?php
                  $currentYear = date('Y');
                  for ($y = $currentYear; $y <= $currentYear + 10; $y++) {
                    echo "<option value=\"{$y}\">{$y}</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <p class="help-text">Select the month and year for the newsletter events</p>
          </div>
          
          <div class="form-group">
            <label for="welcomeTextDe">Welcome Text (German)</label>
            <textarea id="welcomeTextDe" name="welcomeTextDe" required placeholder="Hallo liebe Freund:innen,

hier sind die kommenden Veranstaltungen..."></textarea>
            <p class="help-text">This text appears at the beginning of the newsletter</p>
          </div>
          
          <div class="form-group">
            <label for="welcomeTextEn">Welcome Text (English - displayed in italics)</label>
            <textarea id="welcomeTextEn" name="welcomeTextEn" required placeholder="Hello dear friends,

here are the upcoming events..."></textarea>
            <p class="help-text">English text appears directly below the German text in italics</p>
          </div>
          
          <div class="form-group">
            <label for="imageFile">Upload Picture of the Month</label>
            <input type="file" id="imageFile" name="imageFile" accept="image/*">
            <input type="hidden" id="imageUrl" name="imageUrl">
            <p class="help-text">Optional - Select an image from your computer (JPG, PNG, GIF, WebP)</p>
            <div id="uploadStatus" style="margin-top: 10px; display: none;"></div>
          </div>
          
          <div class="form-group">
            <label for="imageCredits">Image Credits (optional)</label>
            <textarea id="imageCredits" name="imageCredits" rows="2" placeholder="Photo: Max Mustermann
© 2025"></textarea>
            <p class="help-text">Optional - Displayed below the image (line breaks allowed)</p>
          </div>
        </form>
      </div>
      
      <div>
        <div class="card">
          <h2 class="card-title">Events This Month</h2>
          <div id="eventsPreview">
            <p class="empty-state">Select a month to view events</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    const monthSelect = document.getElementById('month');
    const yearSelect = document.getElementById('year');
    const eventsPreview = document.getElementById('eventsPreview');
    const createDraftBtn = document.getElementById('createDraftBtn');
    const messageDiv = document.getElementById('message');
    const imageFileInput = document.getElementById('imageFile');
    const imageUrlInput = document.getElementById('imageUrl');
    const uploadStatus = document.getElementById('uploadStatus');
    
    // Set default to next month
    const today = new Date();
    const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1);
    const monthValue = String(nextMonth.getMonth() + 1).padStart(2, '0');
    const yearValue = String(nextMonth.getFullYear());
    
    monthSelect.value = monthValue;
    yearSelect.value = yearValue;
    
    // Load events for default month
    loadEvents();
    
    function showMessage(text, type = 'success') {
      messageDiv.className = `message ${type}`;
      messageDiv.textContent = text;
      messageDiv.style.display = 'block';
      
      setTimeout(() => {
        messageDiv.style.display = 'none';
      }, 5000);
    }
    
    function getFormData() {
      return {
        monthYear: `${yearSelect.value}-${monthSelect.value}`,
        welcomeTextDe: document.getElementById('welcomeTextDe').value,
        welcomeTextEn: document.getElementById('welcomeTextEn').value,
        imageUrl: document.getElementById('imageUrl').value,
        imageCredits: document.getElementById('imageCredits').value
      };
    }
    
    async function loadEvents() {
      const month = monthSelect.value;
      const year = yearSelect.value;
      
      if (!month || !year) {
        eventsPreview.innerHTML = '<p class="empty-state">Select a month to view events</p>';
        return;
      }
      
      eventsPreview.innerHTML = '<p class="loading">Loading events...</p>';
      
      try {
        const response = await fetch(`/brevo-newsletter/events/${year}/${month}`);
        const data = await response.json();
        
        if (data.success && data.events.length > 0) {
          const eventsList = data.events.map(event => `
            <li class="event-item">
              <div class="event-item-title">
                <span>${event.title}</span>
                ${event.isRecurring ? '<span class="event-badge">recurring</span>' : ''}
              </div>
              <div class="event-meta">${event.date} - ${event.category}</div>
            </li>
          `).join('');
          
          eventsPreview.innerHTML = `
            <ul class="events-list">
              ${eventsList}
            </ul>
          `;
        } else {
          eventsPreview.innerHTML = '<p class="empty-state">No events found for this month</p>';
        }
      } catch (error) {
        console.error('Error loading events:', error);
        eventsPreview.innerHTML = '<p class="empty-state error">Error loading events</p>';
      }
    }
    
    monthSelect.addEventListener('change', loadEvents);
    yearSelect.addEventListener('change', loadEvents);
    
    // Image upload handler
    imageFileInput.addEventListener('change', async (e) => {
      const file = e.target.files[0];
      if (!file) return;
      
      uploadStatus.style.display = 'block';
      uploadStatus.innerHTML = '<span style="color: #4271ae;">Uploading...</span>';
      
      const formData = new FormData();
      formData.append('image', file);
      
      try {
        const response = await fetch('/brevo-newsletter/upload-image', {
          method: 'POST',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
          imageUrlInput.value = data.url;
          uploadStatus.innerHTML = '<span style="color: #10b981;">Image uploaded successfully!</span>';
          setTimeout(() => {
            uploadStatus.style.display = 'none';
          }, 3000);
        } else {
          uploadStatus.innerHTML = '<span style="color: #ef4444;">' + data.message + '</span>';
        }
      } catch (error) {
        console.error('Upload error:', error);
        uploadStatus.innerHTML = '<span style="color: #ef4444;">Upload failed</span>';
      }
    });
    
    createDraftBtn.addEventListener('click', async () => {
      if (!monthSelect.value || !yearSelect.value || !document.getElementById('welcomeTextDe').value || !document.getElementById('welcomeTextEn').value) {
        showMessage('Please fill in all required fields', 'error');
        return;
      }
      
      createDraftBtn.disabled = true;
      createDraftBtn.textContent = 'Creating draft...';
      
      try {
        const response = await fetch('/brevo-newsletter/create-draft-form', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(getFormData())
        });
        
        const data = await response.json();
        
        if (data.success) {
          showMessage('Draft created successfully in Brevo!');
          if (data.campaignUrl) {
            setTimeout(() => {
              window.open(data.campaignUrl, '_blank');
            }, 1000);
          }
        } else {
          showMessage('Error: ' + data.message, 'error');
        }
      } catch (error) {
        console.error('Error:', error);
        showMessage('Error creating draft', 'error');
      } finally {
        createDraftBtn.disabled = false;
        createDraftBtn.textContent = 'Create Draft Newsletter and send to Brevo';
      }
    });
  </script>
</body>
</html>
